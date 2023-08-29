<?php
namespace Trinityrank\GoogleMapWithAutocomplete;

use Laravel\Nova\Fields\Field;

class TRAddress extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'tr-address';

    public function preventEnter()
    {
        return $this->withMeta(['preventEnter' => true]);
    }
}
