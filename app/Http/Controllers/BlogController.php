<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    public function getCreateBlogPage()
    {
        try {
            $categories = DB::table('categories')
                ->select('id', 'name')
                ->get();

            return view('blogs.create', compact('categories'));
        } catch (\Exception $e) {
            return redirect('/create-blog')->with('error', 'Something went wrong while fetching blogs. Please try again later');
        }
    }

    // Create blog with required data
    public function postBlog(Request $request)
    {
        $blogTitle = $request->title;
        $blogDesc = $request->description;
        $blogImg = $request->img_path;
        $blogCategory = $request->category_id;

        // dd($blogTitle, $blogDesc, $blogImg, $blogCategory);
        if (!$blogTitle) {
            return redirect('/create-blog')->with('title-error', 'Blog title is required!!');
        }

        if (!$blogDesc) {
            return redirect('/create-blog')->with('desc-error', 'Blog description is required!!');
        }

        if(!$blogImg){
            return redirect('/create-blog')->with('image-error', 'Blog image url is required!!');
        }

        if(!$blogCategory){
            return redirect('/create-blog')->with('category-error', 'Blog category is required!!');
        }

        try {
            $blogAuthor = DB::table('users')
                ->where('email', 'test@gmail.com')->first();

            $blog = new Blog();

            $blog->title = $blogTitle;
            $blog->description = $blogDesc;
            $blog->img_path = $blogImg;
            $blog->category_id = $blogCategory;
            $blog->author_id = $blogAuthor->id;

            // save to database
            $blog->save();
            return redirect('/create-blog')->with('success', 'Blog posted successfully');
            // return response()->json(['success' => 'Blog posted successfully']);
        } catch (\Exception $e) {
            return redirect('/create-blog')->with('error', 'Something went wrong while posting blog. Please try again later');
            // return response('/create-blog')->json(['error' => 'Something went wrong while posting blogs. Please try again later']);
        }
    }

    // Get All Blogs
    public function getBlogs(Request $request)
    {  
        $categoryId = $request->query('cat');
       
        try {
            $categories = DB::table('categories')->get();
            $query = DB::table('blogs')
                ->leftJoin('categories', 'categories.id', '=', 'blogs.category_id')
                ->leftJoin('users', 'users.id', '=', 'blogs.author_id')
                ->where('blogs.deleted_status', 0)
                ->where('categories.status', 0);
            
            
            if ($categoryId) {

                $categoryExists = DB::table('categories')->where('id', $categoryId);
                if (!$categoryExists) {
                    return redirect('/')->with('error', 'Selected Category is not valid!!');
                }

                $blogs = $query
                    ->orderByDesc('created_at')
                    ->select('blogs.*', 'categories.name', 'users.name')
                    ->where('categories.id', $categoryId)
                    ->get();

                return view('blogs', compact('blogs', 'categories', 'categoryId'));
            } else {
                $blogs = $query
                    ->orderByDesc('created_at')
                    ->select('blogs.*', 'categories.name', 'users.name')
                    ->get();

                return view('blogs', compact('blogs', 'categories', 'categoryId'));
                // return response()->json($blogs);
            }
        } catch (\Exception $e) {
            return redirect('/')->with('error', 'Something went wrong while fetching blogs. Please try again later');
            // return response()->json(['error' => 'Something went wrong while fetching blogs. Please try again later']);
        }
    }

    public function previewBlog(Request $request)
    {
        $blogId = $request->query('blog_id');
        if (!$blogId) {
            return redirect('/')->with('error', 'Select one blog to preview');
        }

        try {
            $blogExists = DB::table('blogs')
                ->leftJoin('categories', 'categories.id', '=', 'blogs.category_id')
                ->leftJoin('users', 'users.id', '=', 'blogs.author_id')
                ->where('blogs.id', $blogId)
                ->where('blogs.deleted_status', 0)
                ->where('categories.status', 0)
                ->select('blogs.*', 'users.name as author_name', 'categories.name as category_name')
                ->first();

            if (!$blogExists) {
                return redirect('/')->with('error', 'Blog does not exists or disabled');
            }

            return view('blogs.preview', compact('blogExists'));
        } catch (\Exception $e) {
            return redirect('/')->with('error', 'Something went wrong while previewing blog. Please try again later');
        }
    }

    public function getEditBlogPage(Request $request)
    {
        $blogId = $request->query('id');
        try {
            // dd($blogId);
            $categories = DB::table('categories')
                ->select('id', 'name')
                ->get();

            $blog = DB::table('blogs')
                ->where('id', $blogId)
                ->first();

            return view('blogs.edit', compact('categories', 'blog'));
        } catch (\Exception $e) {
            return redirect('/edit-blog/' + $blogId)->with('error', 'Something went wrong while fetching blogs. Please try again later');
        }
    }

    // Update one blog
    public function updateBlog(Request $request)
    {
        $blogId = $request->blog_id;
        $blogTitle = $request->title;
        $blogDesc = $request->description;
        $blogImg = $request->img_path;
        $blogCategoryId = $request->category_id;

        // $loggedInUser = Auth::user()->id;

        if (!$blogId) {
            return redirect('/')->with('error', 'Select one blog to update');
        }

        // if (!$blogAuthorId) {
        //     return redirect()->with('error', 'You are must login to post a blog');
        // }

        // if ($loggedInUser != $blogAuthorId) { // checking only authorized person is updating the blog
        //     return redirect()->with('error', 'You are not allowed to do this!!');
        // }

        if (!$blogCategoryId) {
            return redirect('/edit-blog?id='.$blogId)->with('category-error', 'Blog Category is required!!');
        }

        if (!$blogTitle) {
            return redirect('/edit-blog?id='.$blogId)->with('title-error', 'Blog title is required!!');
        }

        if (!$blogDesc) {
            return redirect('/edit-blog?id='.$blogId)->with('desc-error', 'Blog description is required!!');
        }

        try {
            $categoryExists = DB::table('categories')->where('id', $blogCategoryId);
            if (!$categoryExists) {
                return redirect('/edit-blog?id='.$blogId)->with('error', 'Selected Category is not valid!!');
            }

            $blog = Blog::find($blogId);
            $blog->title = $blogTitle;
            $blog->description = $blogDesc;
            $blog->img_path = $blogImg;
            $blog->category_id = $blogCategoryId;
            $blog->updated_at = Carbon::now();

            $blog->save();

            return redirect('/edit-blog?id=' . $blogId)->with('success', 'Updated blog successfully!!');
        } catch (\Exception $e) {
            return redirect('/edit-blog?id=' . $blogId)->with('error', 'Something went wrong while updating blog. Please try again later');
            // return response()->json(['error' => 'Something went wrong while updating blogs. Please try again later']);
        }
    }

    // Delete one blog
    public function deleteBlog(Request $request)
    {
        $blogId = $request->query('id');
        // $blogCategoryId = $request->blog_category;
        // $blogAuthorId = $request->blog_author;

        // $loggedInUser = Auth::user()->id;

        // if (!$blogAuthorId) {
        //     return redirect()->with('error', 'You are must login to delete a blog');
        // }

        // if ($loggedInUser != $blogAuthorId) { // checking only authorized person is updating the blog
        //     return redirect()->with('error', 'You are not allowed to do this!!');
        // }

        try {
            $blog = Blog::find($blogId);
            $blog->deleted_status = 1;
            $blog->save();

            return redirect('/')->with('success', 'Deleted blog successfully!!');
        } catch (\Exception $e) {
            return redirect('/')->with('error', 'Something went wrong while deleting blog. Please try again later');
            // return response()->json(['error' => 'Something went wrong while deleting blogs. Please try again later']);
        }
    }
}   
