<?php

namespace App\Http\Controllers;


use App\Features\ServeAccountInsightsFeature;
use App\Features\ServeContentInsightsFeature;
use App\Features\ServeContentMetricsFeature;

use Lucid\Units\Controller;


class InsightsController extends Controller
{
    public function accountInsights($handle)
    {
        return $this->serve(ServeAccountInsightsFeature::class, [
            'handle' => $handle,
            'platform' => 'instagram'
        ]);
    }

    public function contentInsights($handle)
    {
        return $this->serve(ServeContentInsightsFeature::class, [
            'handle' => $handle,
            'platform' => 'instagram'
        ]);
    }

    public function contentMetrics($handle)
    {
        return $this->serve(ServeContentMetricsFeature::class, [
            'handle' => $handle,
            'platform' => 'instagram'
        ]);
    }
}
