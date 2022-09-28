<?php
namespace Trinityrank\GoogleMapWithAutocomplete;

use Laravel\Nova\Fields\Field;
use Illuminate\Support\Str;
use Laravel\Nova\Http\Requests\NovaRequest;

class TRMap extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'tr-map';

    public function __construct($name, $attribute = null, callable $resolveCallback = null)
    {
        $this->attribute = $attribute ?? str_replace(' ', '_', Str::lower($name));

        parent::__construct($name, $this->attribute);

        $this->apiKey(config('nova-google-maps.google_maps_api_key'))
            ->latitude(config('nova-google-maps.default_latitude'))
            ->longitude(config('nova-google-maps.default_longitude'))
            ->zoom(config('nova-google-maps.default_zoom'));
    }

    public function apiKey($apiKey)
    {
        return $this->withMeta(['api_key' => $apiKey]);
    }

    public function latitude($latitude)
    {
        return $this->withMeta(['latitude' => $latitude]);
    }

    public function longitude($longitude)
    {
        return $this->withMeta(['longitude' => $longitude]);
    }

    public function zoom($zoom)
    {
        return $this->withMeta(['zoom' => $zoom]);
    }

    public function hideLatitude()
    {
        return $this->withMeta(['hide_latitude' => true]);
    }

    public function hideLongitude()
    {
        return $this->withMeta(['hide_longitude' => true]);
    }

    protected function fillAttributeFromRequest(NovaRequest $request, $requestAttribute, $model, $attribute)
    {
        foreach ($request->input($attribute) as $attr => $data) {
            if ($data != 'null') {
                $model->setAttribute($attr, $data);
            }
        }
    }

    public function resolve($resource, $attribute = null)
    {
        if (is_array($resource)) {
            if ($resource['latitude']) {
                $this->latitude(floatval($resource['latitude']));
            }
            if ($resource['longitude']) {
                $this->longitude(floatval($resource['longitude']));
            }
        } else {
            if ($resource->getAttribute('latitude')) {
                $this->latitude(floatval($resource->getAttribute('latitude')));
            }
            if ($resource->getAttribute('longitude')) {
                $this->longitude(floatval($resource->getAttribute('longitude')));
            }
        }
    }
}
