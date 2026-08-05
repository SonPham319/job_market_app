<?php

namespace App\Post;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class JobPost
{
    protected $listing;

    public function __construct(Listing $listing)
    {
        $this->listing = $listing;
    }

    public function getImagePath(Request $data)
    {
        return $data->file('feature_image')->store('images', 'public');
    }

    public function store(Request $data)
    {
        if ($data->hasFile('feature_image')) {
            $this->listing->feature_image = $this->getImagePath($data);
        }

        $this->listing->title = $data['title'];
        $this->listing->predes = $data['predes'];
        $this->listing->user_id = auth()->user()->id;
        $this->listing->description = $data['description'];
        $this->listing->roles = $data['roles'];
        $this->listing->job_type = $data['job_type'];
        $this->listing->address = $data['address'];
        $this->listing->salary = $data['salary'];
        $this->listing->application_close_date = \Carbon\Carbon::createFromFormat('m/d/Y', $data['date'])->format('Y-m-d');
        $this->listing->slug = Str::slug($data['title']) . '.' . Str::uuid();

        $this->listing->save();
    }

    public function updatePost(int $id, Request $data): void
    {
        $listing = $this->listing->find($id);

        if ($data->hasFile('feature_image')) {
            $listing->feature_image = $this->getImagePath($data);
        }

        $listing->title = $data['title'];
        $listing->predes = $data['predes'];
        $listing->description = $data['description'];
        $listing->roles = $data['roles'];
        $listing->job_type = $data['job_type'];
        $listing->address = $data['address'];
        $listing->salary = $data['salary'];
        $listing->application_close_date = \Carbon\Carbon::createFromFormat('m/d/Y', $data['date'])->format('Y-m-d');

        $listing->save();
    }
}