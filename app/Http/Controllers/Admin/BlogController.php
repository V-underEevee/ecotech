<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * Controlador del blog en el panel de administración
 * 
 * Gestiona el CRUD completo de entradas del blog
 */
class BlogController extends Controller
{
    /**
     * Muestra el listado de todas las entradas del blog
     *
     * @return \Illuminate\View\View
     */
    public function index()
{
    $posts = BlogPost::orderBy('created_at', 'desc')->paginate(10);
    return view('admin.blog.index', compact('posts'));
}

    /**
     * Muestra el formulario para crear una nueva entrada
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.blog.create');
    }

    /**
     * Guarda una nueva entrada en la base de datos
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:blog_posts,slug',
            'excerpt' => 'required|string|max:500',
            'content' => 'required|string',
            'author' => 'required|string|max:100',
            'published_date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $data = $request->all();
        $data['is_published'] = $request->has('is_published') ? 1 : 0;

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/blog'), $imageName);
            $data['image'] = '/images/blog/' . $imageName;
        }

        BlogPost::create($data);

        return redirect()->route('admin.blog.index')
            ->with('success', 'Artículo creado correctamente');
    }

    /**
     * Muestra los detalles de una entrada específica
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $blog = BlogPost::findOrFail($id);
        return view('admin.blog.show', compact('blog'));
    }

    /**
     * Muestra el formulario para editar una entrada
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $blog = BlogPost::findOrFail($id);
        return view('admin.blog.edit', compact('blog'));
    }

    /**
     * Actualiza una entrada existente
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $blog = BlogPost::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:blog_posts,slug,' . $id,
            'excerpt' => 'required|string|max:500',
            'content' => 'required|string',
            'author' => 'required|string|max:100',
            'published_date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $data = $request->all();
        $data['is_published'] = $request->has('is_published') ? 1 : 0;

        if ($request->hasFile('image')) {
            if ($blog->image && file_exists(public_path($blog->image))) {
                unlink(public_path($blog->image));
            }
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/blog'), $imageName);
            $data['image'] = '/images/blog/' . $imageName;
        }

        $blog->update($data);

        return redirect()->route('admin.blog.index')
            ->with('success', 'Artículo actualizado correctamente');
    }

    /**
     * Elimina una entrada del blog
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $blog = BlogPost::findOrFail($id);

        if ($blog->image && file_exists(public_path($blog->image))) {
            unlink(public_path($blog->image));
        }

        $blog->delete();

        return redirect()->route('admin.blog.index')
            ->with('success', 'Artículo eliminado correctamente');
    }
}