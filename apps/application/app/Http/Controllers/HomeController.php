<?php

namespace App\Http\Controllers;

use App\Http\Resources\Api\StudentResource;
use App\Models\Student;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class HomeController extends Controller
{
    /**
     * allow instructors or admins to search for students
     *
     * @return Response|ResponseFactory
     */
    public function search(Request $request): Response|ResponseFactory
    {
        /**
         * @any('/search/student')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        $search = $request->get('search', '');
        $results_query = Student::with(['studentType', 'phones', 'address.state', 'school.address.state']);

        if (! $search) {
            return inertia('Search', [
                'search'  => $search,
                'results' => StudentResource::collection($results_query->get()),
            ]);
        }
        $new_search = '%'.$search.'%';

        $results_query
            ->where('first_name', 'like', $new_search)
            ->orWhere('middle_name', 'like', $new_search)
            ->orWhere('last_name', 'like', $new_search)
            ->orWhere('email', 'like', $new_search);

        return inertia('Search', [
            'search'  => $search,
            'results' => StudentResource::collection($results_query->get()),
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return Response|ResponseFactory
     */
    public function index(): Response|ResponseFactory
    {
        /**
         * @get('/')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         *
         * @get('/dashboard')
         * @name('dashboard')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         *
         * @get('/home')
         * @middlewares('web', 'tenant-web', 'tenant-instructors')
         */
        return inertia('Home');
    }
}
