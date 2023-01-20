<?php

namespace App\Http\Controllers;

use App\Helpers\LeagueHelper;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class MatchController
{
    public function apply_filters(Request $request): RedirectResponse
    {
        $request->validate([
            'sex' => 'required|string',
            'league' => 'required|int|min:0|max:4'
        ]);
        $sex = $request->input('sex');
        $league = intval($request->input('league'));
        if (in_array($sex, ['all', 'Mężczyzna', 'Kobieta'])) {
            Session::put('sex', $sex);
        }
        Session::put('min_league', $league);
        return redirect('match/find');
    }
    public function find_match(): View
    {
        /**
         * @var User $user
         */
        $user = Auth::user();

        /**
         * @var array<User> $users
         */
        $users = User::all();

        $alreadyMatched = $user->matches()->get()->all();

        array_walk($alreadyMatched, function (&$item, $key) {
            $item = $item->match_id;
        });
        $match = null;
        $score = INF;

        $minLeague = Session::get('min_league')?? 0;
        $sex = Session::get('sex')?? 'all';
        foreach ($users as $matchCandidate) {
            $candidateProfile = $matchCandidate->profile;
            $userProfile = $user->profile;
            if (!($candidateProfile instanceof UserProfile) || !($userProfile instanceof UserProfile)) {
                continue;
            }
            if ($sex != 'all' && $candidateProfile->sex != $sex) {
                continue;
            }
            if ($candidateProfile->league < $minLeague) {
                continue;
            }
            if ($matchCandidate->id != $user->id && !in_array($matchCandidate->id, $alreadyMatched)) {
                $match_score = abs($userProfile->favourite_number - $candidateProfile->favourite_number);
                if ($match_score < $score) {
                    $score = $match_score;
                    $match = $matchCandidate;
                }
            }
        }
        $matchLeague = $match && $match->profile && $match->profile instanceof UserProfile ? LeagueHelper::getLeague($match->profile->league) : "";
        return view('match.find', ['matchLeague' => $matchLeague,'match' => $match, 'sex' => $sex, 'minLeague' => $minLeague]);
    }
    public function show_matches(): View
    {
        /**
         * @var User $user
         */
        $user = Auth::user();

        $userMatches = $user->matches()->where('accepted', true)->get()->all();
        $userMatched = $user->matchedBy()->where('accepted', true)->get()->all();

        array_walk($userMatches, function (&$item, $key) {
            $item = $item->match_id;
        });

        array_walk($userMatched, function (&$item, $key) {
            $item = $item->user_id;
        });

        $matches = array();
        foreach ($userMatches as $match) {
            if (in_array($match, $userMatched)) {
                $matched = User::find($match);
                $matches[] = $matched;
            }
        }

        return view('match.show', ['users' => $matches]);
    }

    public function accept_match(Request $request): RedirectResponse
    {
        $request->validate([
            'matchId' => 'required|int',
            'accept' => 'required'
        ]);
        $matchId = intval($request->input('matchId'));
        /**
         * @var User $user
         */
        $user = Auth::user();
        if (!($user instanceof User)) {
            return abort(404);
        }
        $id = $user->id;
        $match = User::find($matchId);
        if (!($match instanceof User)) {
            return abort(404);
        }
        $this->add_match_to_db($id, $matchId, true);

        $matchMatches = $match->matches()->where('accepted', true)->get()->all();
        array_walk($matchMatches, function (&$item, $key) {
            $item = $item->match_id;
        });

        if (in_array($user->id, $matchMatches)) {
            return redirect('match/notification');
        }
        return redirect('match/find');
    }
    public function deny_match(Request $request): RedirectResponse
    {
        $request->validate([
            'matchId' => 'required|int',
            'deny' => 'required'
        ]);

        $id = (int) Auth::id();
        $matchId = intval($request->input('matchId'));
        $this->add_match_to_db($id, $matchId, false);
        return redirect('match/find');
    }

    private function add_match_to_db(int $userId, int $matchedId, bool $accepted): void
    {
        DB::table('match_history')->insert([
            'user_id' => $userId,
            'match_id' => $matchedId,
            'accepted' => $accepted
        ]);
        DB::flushQueryLog();
    }
    public function notify(): View
    {
        return view('match.notification');
    }
}
