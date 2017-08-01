<?php

namespace App\Http\Controllers;

use App\Redirect;
use App\View;
use Illuminate\Http\Request;
use \Carbon\Carbon;
use App\Http\Requests;
use App\Job;
use DB;
use Illuminate\Support\Facades\Input;
use PhpParser\Serializer\XML;

class JobsController extends Controller
{
    protected function index() {
        $jobs = Job::orderBy('created_at', 'desc');
        $input = Input::all();
        if(isset($input['search']))
            $jobs = Job::orderBy('created_at', 'desc')->orWhere(DB::raw("CONCAT(`city`, ' ', `state`)"), 'LIKE', "%".$input['search']."%");
        $jobs = Job::shuffle($jobs);
        $jobs_location = Job::orderBy('created_at', 'desc')->get()->slice(0, 5);

        $categories = DB::table('jobs')->distinct('category')->select('category')->get()->toArray();
        $cities = DB::table('jobs')->distinct('city')->select('city', 'state', 'title', 'id')->get()->toArray();
        $companies = DB::table('jobs')->distinct('company_name')->select('company_name')->get()->toArray();

        return view('index', compact('jobs', 'jobs_location', 'categories', 'cities', 'states', 'companies'));
    }

    protected function search(Request $request) {
        $query = Job::orderBy('created_at', 'desc');
        $search = array_except($request->toArray(), '_token');
        $pipelines = [
            'hispanic-american' => 'Hispanic American Pipeline',
            'asian-american' => 'Asian American Pipeline',
            'african-american' => 'African American Pipeline',
            'native-american' => 'Native American Pipeline',
            'veterans' => 'War Veterans Pipeline',
            'lgbt' => 'LGBT Pipeline',
            'disabled' => 'Disabled Pipeline',
        ];

        if(isset($search['date']) && $search['date'] != '')
            $query->whereBetween('created_at', [Carbon::now()->subDay($search['date']), Carbon::now()]);
        foreach(array_except($search, ['pipeline', 'date']) as $key => $value) {
            if($value == '')
                continue;
            if($key == 'search')
                $query->orWhere('title', 'like', '%'.$value.'%')->orWhere('company_name', 'like', '%'.$value.'%')->orWhere(DB::raw("CONCAT(`city`, ', ', `state`)"), 'LIKE', "%".$value."%");
            else
                $query->where($key, 'like', '%'.$value.'%');
        }
        $jobs = Job::shuffle($query);
        $jobs_location = Job::orderBy('created_at', 'desc')->get()->slice(0, 5);
        $i = Input::all();
        if(isset($input['search']))
            $jobs = Job::orderBy('created_at', 'desc')->orWhere('title', 'LIKE', "%".$input['search']."%")->orWhere(DB::raw("CONCAT(`city`, ' ', `state`)"), 'LIKE', "%".$input['search']."%")->paginate(15);

        $categories = DB::table('jobs')->distinct('category')->select('category')->get()->toArray();
        $cities = DB::table('jobs')->distinct('city')->select('city', 'state', 'title', 'id')->get()->toArray();
        $companies = DB::table('jobs')->distinct('company_name')->select('company_name')->get()->toArray();

        return view('search', compact('jobs', 'pipelines', 'search', 'jobs_location', 'i', 'categories', 'cities', 'states', 'companies'));
    }

    protected function category($cat) {
        $jobs = Job::shuffle(Job::orderBy('created_at', 'desc')->where('category', '=', $cat));
        $jobs_location = Job::orderBy('created_at', 'desc')->get()->slice(0, 5);
        $input = Input::all();

        $categories = DB::table('jobs')->distinct('category')->select('category')->get()->toArray();
        $cities = DB::table('jobs')->distinct('city')->select('city', 'state')->get()->toArray();
        $companies = DB::table('jobs')->distinct('company_name')->select('company_name')->get()->toArray();

        return view('index', compact('jobs', 'jobs_location', 'input', 'cat', 'categories', 'cities', 'states', 'companies'));
    }

    protected function city($cat) {
        $jobs = Job::shuffle(Job::orderBy('created_at', 'asc')->where('city', 'LIKE', $cat));
        $input = Input::all();
        $jobs_location = Job::orderBy('created_at', 'desc')->get()->slice(0, 5);

        $categories = DB::table('jobs')->distinct('category')->select('category')->get()->toArray();
        $cities = DB::table('jobs')->distinct('city')->select('city', 'state')->get()->toArray();
        $companies = DB::table('jobs')->distinct('company_name')->select('company_name')->get()->toArray();

        return view('index', compact('jobs', 'jobs_location', 'input', 'cat', 'categories', 'cities', 'states', 'companies'));
    }

    protected function company($cat) {
        $jobs = Job::shuffle(Job::orderBy('created_at', 'desc')->where('company_name', '=', $cat));
        $input = Input::all();
        $jobs_location = Job::orderBy('created_at', 'desc')->get()->slice(0, 5);

        $categories = DB::table('jobs')->distinct('category')->select('category')->get()->toArray();
        $cities = DB::table('jobs')->distinct('city')->select('city', 'state')->get()->toArray();
        $companies = DB::table('jobs')->distinct('company_name')->select('company_name')->get()->toArray();

        return view('index', compact('jobs', 'jobs_location', 'input', 'cat', 'categories', 'cities', 'states', 'companies'));
    }

    public function show($id) {
        $job = Job::find($id);
        View::create(['job' => $id]);
        $jobs_location = Job::orderBy('created_at', 'desc')->get()->slice(0, 5);

        $categories = DB::table('jobs')->distinct('category')->select('category')->get()->toArray();
        $cities = DB::table('jobs')->distinct('city')->select('city', 'state')->get()->toArray();
        $companies = DB::table('jobs')->distinct('company_name')->select('company_name')->get()->toArray();

        return view('show', compact('job', 'jobs_location', 'input', 'categories', 'cities', 'states', 'companies'));
    }

    public function redirectTo($id) {
        $job = Job::find($id);
        Redirect::create(['job' => $id]);

        return redirect($job->url);
    }

    public function views($company) {
        $return = [];

        $jobs = Job::where('parent_company', '=', $company)->get();
        foreach($jobs as $job) {
            $return[$job->id] = $job->views->toArray();
        }

        return $return;
    }

    public function clicks($company) {
        $return = [];

        $jobs = Job::where('parent_company', '=', $company)->get();
        foreach($jobs as $job) {
            $return[$job->id] = $job->clicks->toArray();
        }

        return $return;
    }

    public function feed(Request $request) {
        $jobs = $request['jobs'];
        $inserts = [];
        if(!empty($jobs)) {
            foreach($jobs as $job) {
                $job['status'] = 'active';
                $job['title'] = isset($job['title']) ? $job['title'] : '';
                $job['city'] = isset($job['city']) ? $job['city'] : '';
                $job['state'] = isset($job['state']) ? $job['state'] : '';
                $job['ref'] = isset($job['ref']) ? $job['ref'] : '';
                $job['url'] = isset($job['url']) ? $job['url'] : '';
                $job['company_name'] = isset($job['company_name']) ? $job['company_name'] : '';
                $job['description'] = isset($job['description']) ? $job['description'] : '';
                $job['qualifications'] = isset($job['qualifications']) ? $job['qualifications'] : '';
                $job['category'] = isset($job['category']) ? $job['category'] : '';

                $new_job = Job::create($job);
                $new_job->parent_company = isset($job['company_id']) ? $job['company_id'] : 3;
                $new_job->parent_job = $job['id'];
                $new_job->save();

                $inserts[] = ['tracking_id' => $new_job->id, 'parent_id' => $job['id']];
            }
        }

        return $inserts;
    }
}
