<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->input('filter', 'pending');

        $testimonials = Testimonial::query()
            ->when($filter === 'pending', fn ($query) => $query->where('is_approved', false))
            ->when($filter === 'approved', fn ($query) => $query->where('is_approved', true))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.testimonials.index', compact('testimonials', 'filter'));
    }

    public function approve(Testimonial $testimonial)
    {
        $testimonial->update(['is_approved' => ! $testimonial->is_approved]);

        $status = $testimonial->is_approved ? 'disetujui' : 'dibatalkan persetujuannya';

        return back()->with('success', "Testimoni berhasil {$status}.");
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();

        return back()->with('success', 'Testimoni berhasil dihapus.');
    }
}
