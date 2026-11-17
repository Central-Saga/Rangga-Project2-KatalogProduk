<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTestimonialRequest;
use App\Models\Testimonial;

class TestimonialController extends Controller
{
    public function store(StoreTestimonialRequest $request)
    {
        Testimonial::create([
            ...$request->validated(),
            'is_approved' => false,
        ]);

        return back()->with('success', 'Terima kasih! Testimoni Anda akan tampil setelah disetujui admin.');
    }
}
