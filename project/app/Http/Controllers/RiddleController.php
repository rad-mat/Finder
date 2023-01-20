<?php

namespace App\Http\Controllers;

use App\Helpers\HasEnsure;
use App\Models\Riddle;
use App\Models\UserProfile;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Illuminate\Http\Request;

class RiddleController extends Controller
{
    use HasEnsure;

    public const RIDDLES_PER_PAGE = 5;

    public function index(): RedirectResponse
    {
        return redirect('/riddles/page/' . 1);
    }

    public function filter(Request $request): RedirectResponse
    {
        Session::put('category', $request->category);
        if (auth()->user()) {
            Session::put('isAnsweredChecked', $request->has('answeredBoxValue'));
        }
        return redirect('/riddles/page/' . 1);
    }

    public function answer(Request $request): RedirectResponse
    {
        $user = $this->ensureIsNotNullUser($request->user());
        $profile = $user->profile;
        $riddle = Riddle::find($request->riddleId);

        if ($profile instanceof UserProfile && $riddle instanceof Riddle) {
            if ($request->filledAnswer != $riddle->answer) {
                return back()->withErrors(['riddle' => "Zła odpowiedź!"]);
            }

            $solvedCount = $profile->points + 1;

            $profile->league = $this->getNewLeague($solvedCount);
            $profile->points = $solvedCount;
            $profile->solved_riddles = $profile->solved_riddles . $request->riddleId . ",";
            $profile->save();

            return back();
        }
        return back()->withErrors(['riddle' => "Wystąpił błąd!"]);
    }

    public function random(): RedirectResponse
    {
        $riddle = $this->getRiddles()->random();
        return redirect()->route('riddles.show', ['riddle' => $riddle]);
    }

    public function page(int $noPage): RedirectResponse|View
    {
        $riddles = $this->getRiddles();

        $riddlesCount = $riddles->count();
        if ($noPage < 1) {
            $noPage = 1;
            return redirect()->route('riddles.page', ['noPage' => $noPage]);
        } elseif ($riddlesCount <= ($noPage - 1) * self::RIDDLES_PER_PAGE) {
            $noPage = ceil($riddlesCount / self::RIDDLES_PER_PAGE);
            return redirect()->route('riddles.page', ['noPage' => $noPage]);
        }

        $riddles = $riddles->slice(($noPage - 1) * self::RIDDLES_PER_PAGE, self::RIDDLES_PER_PAGE);
        $categories = Riddle::select('category')->distinct()->pluck('category');
        $selected = Session::get('category') ?? 'all';
        $isAnsweredChecked = Session::get('isAnsweredChecked') ?? false;
        $answered = $this->getAnswered();

        return view('riddles.index', ['riddles' => $riddles, 'categories' => $categories, 'selected' => $selected, 'isAnsweredChecked' => $isAnsweredChecked, 'answered' => $answered]);
    }

    public function show(Riddle $riddle): View
    {
        $isSolved = in_array($riddle->id, $this->getAnswered());
        return view('riddles.show', ['riddle' => $riddle, 'solved' => $isSolved]);
    }

    /**
     * @return Collection<int, Riddle>
     */
    private function getRiddles(): Collection
    {
        $selected = Session::get('category') ?? 'all';
        if (Session::get('isAnsweredChecked')) {
            $answered = $this->getAnswered();
        } else {
            $answered = [];
        }

        if ($selected == "all" && empty($answered)) {
            return Riddle::all();
        } elseif ($selected != "all" && empty($answered)) {
            return Riddle::where('category', Session::get('category'))->get();
        } elseif ($selected == "all" && !empty($answered)) {
            return Riddle::whereNotIn('id', $answered)->get();
        } else {
            return Riddle::where('category', Session::get('category'))->whereNotIn('id', $answered)->get();
        }
    }

    /**
     * @return array<string>
     */
    private function getAnswered(): array
    {
        $user = auth()->user();
        if ($user) {
            $profile = $user->profile;
            if ($profile instanceof UserProfile) {
                return explode(",", $profile->solved_riddles);
            }
        }
        return [];
    }

    private function getNewLeague(int $solvedCount): int
    {
        $riddlesCount = count(Riddle::all());
        return (int)(($solvedCount / $riddlesCount) * 5);
    }
}
