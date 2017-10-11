<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Comment;
use App\User;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

	protected function index()
	{
		$comments = $this->getDailyComments();

		$user_comments = $this->getCommentsByUser();

		//dd($user_comments);

		return view('report.index', [
			'comments' => $comments,
			'user_comments' => $user_comments,
		]);
	}

	/**
	 * Get daily comments on current week.
	 *
	 * @return array
	 */
	protected function getDailyComments()
	{
		$date = date('Y-m-d'); // today

		$first = 1; // use Monday as the first day of the week
		$w = date('w', strtotime($date)); // on which day on the current week
		//$now_start = date('Y-m-d', strtotime("$date -".($w ? $w - $first : 6).' days')); // the first day of the current week

		$comments = array(); // Comments based on work day on current week
		for ($i = $first - 1; $i < (int)$w; $i++) {
			$comments[$i] = Comment::where('tenant_id', Auth::user()->tenant_id)
									->where('created_at', '>', date('Y-m-d H:i:s', strtotime('today midnight ' . ($i + $first - (int)$w) . ' days' )))
									->where('created_at', '<', date('Y-m-d H:i:s', strtotime('today midnight ' . ($i + $first + 1 - (int)$w) . ' days' )))
									->get();
		}

		return $comments;
	}

	/**
	 * Get daily comments on current week.
	 *
	 * @return array
	 */
	protected function getCommentsByUser()
	{
		$date = date('Y-m-d'); // current date
		$w = date('w', strtotime($date)); // on which day on the current week

		$user_comments = array(); // Comments sorted by user id on current week

		$users = User::where('tenant_id', '=', Auth::user()->tenant_id)->get();
		foreach ($users as $user) {
			$user_comment = Comment::where('tenant_id', '=', Auth::user()->tenant_id)
						->where('user_id', '=', $user->id)
						->where('created_at', '>', date('Y-m-d H:i:s', strtotime('today midnight ' . (1-(int)$w) . ' days' )))
						->get();
			if ($user_comment != null && count($user_comment) > 0) {
				//$user_comment['username'] = $user->name;
				$user_comments[$user->id] = $user_comment;
			}
		}

		return $user_comments;
	}
}
