import TRMapIndexField from './components/TRMap/IndexField'
import TRMapDetailField from './components/TRMap/DetailField'
import TRMapFormField from './components/TRMap/FormField'

import TRCountryFormField from './components/TRCountry/FormField'
import TRCountryIndexField from './components/TRCountry/IndexField'
import TRCountryDetailField from './components/TRCountry/DetailField'

import TRStateFormField from './components/TRState/FormField'
import TRStateIndexField from './components/TRState/IndexField'
import TRStateDetailField from './components/TRState/DetailField'

import TRCityFormField from './components/TRCity/FormField'
import TRCityIndexField from './components/TRCity/IndexField'
import TRCityDetailField from './components/TRCity/DetailField'

import TRZipCodeFormField from './components/TRZipCode/FormField'
import TRZipCodeIndexField from './components/TRZipCode/IndexField'
import TRZipCodeDetailField from './components/TRZipCode/DetailField'

import TRAddressFormField from './components/TRAddress/FormField'
import TRAddressIndexField from './components/TRAddress/IndexField'
import TRAddressDetailField from './components/TRAddress/DetailField'

import VueGoogleMaps from '@fawmi/vue-google-maps'

Nova.booting((app, store) => {
    app.use(VueGoogleMaps, {
        load: {
            key: Nova.appConfig.api_key,
            libraries: 'places'
        }
    })

    app.component('form-tr-country', TRCountryFormField)
    app.component('index-tr-country', TRCountryIndexField)
    app.component('detail-tr-country', TRCountryDetailField)

    app.component('form-tr-state', TRStateFormField)
    app.component('index-tr-state', TRStateIndexField)
    app.component('detail-tr-state', TRStateDetailField)

    app.component('form-tr-city', TRCityFormField)
    app.component('index-tr-city', TRCityIndexField)
    app.component('detail-tr-city', TRCityDetailField)

    app.component('form-tr-zip-code', TRZipCodeFormField)
    app.component('index-tr-zip-code', TRZipCodeIndexField)
    app.component('detail-tr-zip-code', TRZipCodeDetailField)

    app.component('form-tr-address', TRAddressFormField)
    app.component('index-tr-address', TRAddressIndexField)
    app.component('detail-tr-address', TRAddressDetailField)

    app.component('index-tr-map', TRMapIndexField)
    app.component('detail-tr-map', TRMapDetailField)
    app.component('form-tr-map', TRMapFormField)
})
