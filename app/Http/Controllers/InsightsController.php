<?php

namespace App\Http\Controllers;


use App\Features\ServeAccountInsightsFeature;
use Illuminate\Http\Request;
use Lucid\Units\Controller;


class InsightsController extends Controller
{
    public function account($handle)
    {
        return $this->serve(ServeAccountInsightsFeature::class, [
            'handle' => $handle,
            'platform' => 'instagram'
        ]);
    }

    public function contentInsights($handle)
    {

    }

    public function contentMetrics($handle)
    {

    }
}
