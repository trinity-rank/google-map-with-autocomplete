<template>
    <DefaultField
        :field="field"
        :errors="errors"
        :show-help-text="showHelpText"
    >
        <template #field>
            <GMapAutocomplete
                id="address"
                class="w-full form-control form-input form-input-bordered"
                :class="errorClasses"
                @place_changed="setPlace"
                autocomplete="nope"
            />
        </template>
    </DefaultField>
</template>

<script>
import { FormField, HandlesValidationErrors } from 'laravel-nova'

export default {
    mixins: [FormField, HandlesValidationErrors],

    props: ['resourceName', 'resourceId', 'field'],

    data() {
        return {
            value: null
        }
    },

    mounted() {
        this.$nextTick(function () {
            setTimeout(function () {
                document
                    .getElementById('address')
                    .setAttribute('autocomplete', 'nope')
            }, 1000)
        })
        document.querySelector('#address').value = this.field.value
        Nova.$on('address-update', data => {
            this.value = data
            document.querySelector('#address').value = data
        })
    },

    methods: {
        /*
         * Set the initial, internal value for the field.
         */
        setInitialValue() {
            this.value = this.field.value || ''
        },
        /**
         * Fill the given FormData object with the field's internal value.
         */
        fill(formData) {
            formData.append(this.field.attribute, this.value || '')
        },
        setPlace(place) {
            for (const component of place.address_components) {
                const componentType = component.types[0]
                switch (componentType) {
                    case 'postal_code': {
                        Nova.$emit('zip-code-update', component.long_name)
                        break
                    }
                    case 'postal_code_suffix': {
                        Nova.$emit('zip-code-update', component.long_name)
                        break
                    }
                    case 'locality': {
                        Nova.$emit('city-update', component.long_name)
                        break
                    }
                    case 'administrative_area_level_1': {
                        Nova.$emit('state-update', component.long_name)
                        break
                    }
                    case 'country':
                        Nova.$emit('country-update', component.long_name)
                        break
                }
            }

            this.value = place.formatted_address
            Nova.$emit('latitude-update', place.geometry.location.lat())
            Nova.$emit('longitude-update', place.geometry.location.lng())
        }
    }
}
</script>
