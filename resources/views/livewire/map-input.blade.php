<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                
                <div class="card-header bg-dark text-white">
                    MapBox
                </div>
                <div class="card-body">
                    <div wire:ignore id='map' style='width: 100%; height: 80vh;'></div>
                </div>
            </div>

        </div>
    </div>
</div>


@push('scripts')
    <script>
        document.addEventListener('livewire:load', () => {
            const defaultLocation = [107.63191454609608, -6.974168701034344]

            mapboxgl.accessToken = '{{ env('MAPBOX_KEY') }}';
            var map = new mapboxgl.Map({
                container: 'map',
                center: defaultLocation,
                zoom: 15.15,
                // style: 'mapbox://styles/mapbox/streets-v11'
            });




            const loadLocations = (geoJson) => {
                geoJson.features.forEach((location) => {
                    const {
                        geometry,
                        properties
                    } = location
                    const {
                        iconSize,
                        locationId,
                        title,
                        image,
                        description
                    } = properties

                    let markerElement = document.createElement('div')
                    markerElement.className = 'marker' + locationId
                    markerElement.id = locationId
                    markerElement.style.backgroundImage =
                        'url(https://cdn-icons-png.flaticon.com/512/25/25613.png)'
                    markerElement.style.backgroundSize = 'cover'
                    markerElement.style.width = '50px'
                    markerElement.style.height = '50px'

                    const imageStorage = '{{ asset('/storage/images') }}' + '/' + image

                    const content = `
                    <div style="overflow-y, auto;max-height:400px,width:100%">
                    <table class="table table-sm mt-2">
                        <tbody>
                            <tr>
                                <td>Title</td>
                                <td>${title}</td>
                            </tr>
                            <tr>
                                <td>Foto</td>
                                <td><img src="${imageStorage}" loading="lazy" class = "img-fluid"</td>
                            </tr>
                            <tr>
                                <td>Deskripsi</td>
                                <td>${description}</td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                     `

                    markerElement.addEventListener('click', (e) => {
                        const locationId = e.target.id
                        @this.findLocationById(locationId)
                    })

                    const popUp = new mapboxgl.Popup({
                        offset: 25
                    }).setHTML(content).setMaxWidth("350px")

                    new mapboxgl.Marker(markerElement)
                        .setLngLat(geometry.coordinates)
                        .setPopup(popUp)
                        .addTo(map)

                })
            }

            loadLocations({!! $geoJson !!})

            window.addEventListener('locationAdded', (e) => {
                loadLocations(JSON.parse(e.detail))
            })
            window.addEventListener('updateLocation', (e) => {
                loadLocations(JSON.parse(e.detail))
                $('.mapboxgl-popup').remove()
            })
            window.addEventListener('deleteLocation', (e) => {
                $('.marker' + e.detail).remove()
                $('.mapboxgl-popup').remove()
            })




            const style = "streets-v11"
            // kalo mau ganti style ngab -> light-v10,outdoors-v11,satellite-v9,streets-v11,dark-v10
            map.setStyle(`mapbox://styles/mapbox/${style}`)
            map.addControl(new mapboxgl.NavigationControl())

            map.on('click', (e) => {
                const longtitude = e.lngLat.lng
                const latitude = e.lngLat.lat

                @this.long = longtitude
                @this.lat = latitude
            })
        })
    </script>
@endpush
