<div class="container-fluid">
    <div class=row>
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
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    Form
                </div>
                <div class="card-body">
                    <form
                        @if ($isEdit) wire:submit.prevent="updateLocation"
                        @else
                        wire:submit.prevent="saveLocation" @endif>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Longtitude</label>
                                    <input wire:model="long" type="text" class="form-control">
                                    @error('long')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label>Latitude</label>
                                <input wire:model="lat" type="text" class="form-control">
                                @error('lat')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Title</label>
                            <input wire:model="title" type="text" class="form-control">
                            @error('title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea wire:model="description" class="form-control"> </textarea>
                            @error('description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                        </div>
                        <div class="form-group">
                            <label>Picture</label>
                            <label for="formFile" class="form-label"></label>
                            <input wire:model="image" class="form-control" type="file" id="formFile">

                            @error('image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                            @if ($image)
                                <img src="{{ $image->temporaryUrl() }}" class="img-fluid">
                            @endif

                            @if ($imageUrl && !$image)
                                <img src="{{ asset('/storage/images/' . $imageUrl) }}" class="img-fluid">
                            @endif

                        </div>
                        <div class="form-group">
                            <button type="submit"
                                class="btn btn-dark text-white btn-block">{{ $isEdit ? 'Update Location' : 'Submit Location' }}</button>
                            @if ($isEdit)
                                <button wire:click="deleteLocation" type="button"
                                    class="btn btn-danger text-white btn-block">Delete Location</button>
                            @endif
                        </div>

                    </form>
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
                        image,
                        title,
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
                                <td>Foto</td>
                                <td><img src="${imageStorage}" loading="lazy" class = "img-fluid"</td>
                            </tr>
                            <tr>
                                <td>Title</td>
                                <td>${title}</td>
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

{{-- 
<div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-dark text-white">Maps</div>
                <div wire:ignore id="map" style='width: 100%; height: 80vh;'></div>
                <!-- <pre wire:ignore id="info"></pre> -->
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Form</span>
                        @if ($isEdit)
                            <button wire:click="clearForm" class="btn btn-success active">New Location</button>
                        @endif
                    </div>
                </div>
                <div class="card-body" style="background-color: #454647">
                    <form
                        @if ($isEdit) wire:submit.prevent="update"
                        @else
                        wire:submit.prevent="store" @endif>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="text-white">Longtitude</label>
                                    <input type="text" wire:model="long" class="form-control dark-input"
                                        {{ $isEdit ? 'disabled' : null }} />

                                    @error('long')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="text-white">Latitude</label>
                                    <input type="text" wire:model="lat" class="form-control dark-input"
                                        {{ $isEdit ? 'disabled' : null }} />

                                    @error('lat')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="text-white">Title</label>
                            <input type="text" wire:model="title" class="form-control dark-input" />

                            @error('title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="text-white">Description</label>
                            <textarea wire:model="description" class="form-control dark-input"></textarea>

                            @error('description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="text-white">Image</label>
                            <div class="custom-file dark-input">
                                <input wire:model="image" type="file" class="custom-file-input" id="customFile">

                            </div>

                            @error('image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            @if ($image)
                                <img src="{{ $image->temporaryUrl() }}" class="img-fluid" alt="Preview Image">
                            @endif
                            @if ($imageUrl && !$image)
                                <img src="{{ asset('/storage/images/' . $imageUrl) }}" class="img-fluid"
                                    alt="Preview Image">
                            @endif
                        </div>
                        <div class="form-group">
                            <div>

                                <button type="submit"
                                class="btn active btn-{{ $isEdit ? 'success text-white' : 'primary' }} btn-block">{{ $isEdit ? 'Update Location' : 'Submit Location' }}</button>
                            </div>
                            @if ($isEdit)
                            <div>
                                    <button wire:click="deleteLocationById" type="button"
                                        class="btn btn-danger active btn-block">Delete Location</button>
                                        @endif
                                    </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<div id="info" style="display:none"></div>



@push('script')
    <script src='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.js'></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


    <script>
        document.addEventListener('livewire:load', () => {

            const defaultLocation = [106.697, -6.313];
            const coordinateInfo = document.getElementById('info');

            mapboxgl.accessToken = "{{ env('MAPBOX_KEY') }}";
            let map = new mapboxgl.Map({
                container: "map",
                center: defaultLocation,
                zoom: 11.15,
                style: "mapbox://styles/mapbox/streets-v11"
            });

            map.addControl(new mapboxgl.NavigationControl());

            const loadGeoJSON = (geojson) => {

                geojson.features.forEach(function(marker) {
                    const {
                        geometry,
                        properties
                    } = marker
                    const {
                        iconSize,
                        locationId,
                        title,
                        image,
                        description
                    } = properties

                    let el = document.createElement('div');
                    el.className = 'marker' + locationId;
                    el.id = locationId;
                    el.style.backgroundImage = 'url({{ asset('image/car2.png') }})';
                    el.style.backgroundSize = 'cover';
                    el.style.width = iconSize[0] + 'px';
                    el.style.height = iconSize[1] + 'px';

                    const pictureLocation = '{{ asset('/storage/images') }}' + '/' + image

                    const content = `
                <div style="overflow-y: auto; max-height:400px;width:100%;">
                    <table class="table table-sm mt-2">
                         <tbody>
                            <tr>
                                <td>Title</td>
                                <td>${title}</td>
                            </tr>
                            <tr>
                                <td>Picture</td>
                                <td><img src="${pictureLocation}" loading="lazy" class="img-fluid"/></td>
                            </tr>
                            <tr>
                                <td>Description</td>         
                                <td>${description}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                `;

                    let popup = new mapboxgl.Popup({
                        offset: 25
                    }).setHTML(content).setMaxWidth("400px");

                    el.addEventListener('click', (e) => {
                        const locationId = e.toElement.id
                        @this.findLocationById(locationId)
                    });

                    new mapboxgl.Marker(el)
                        .setLngLat(geometry.coordinates)
                        .setPopup(popup)
                        .addTo(map);
                });
            }

            loadGeoJSON({!! $geoJson !!})

            window.addEventListener('locationAdded', (e) => {
                swal({
                    title: "Location Added!",
                    text: "Your location has been save sucessfully!",
                    icon: "success",
                    button: "Ok",
                }).then((value) => {
                    loadGeoJSON(JSON.parse(e.detail))
                });
            })

            window.addEventListener('deleteLocation', (e) => {
                console.log(e.detail);
                swal({
                    title: "Location Delete!",
                    text: "Your location deleted sucessfully!",
                    icon: "success",
                    button: "Ok",
                }).then((value) => {
                    $('.marker' + e.detail).remove();
                    $('.mapboxgl-popup').remove();
                });
            })

            window.addEventListener('updateLocation', (e) => {
                console.log(e.detail);
                swal({
                    title: "Location Update!",
                    text: "Your location updated sucessfully!",
                    icon: "success",
                    button: "Ok",
                }).then((value) => {
                    loadGeoJSON(JSON.parse(e.detail))
                    $('.mapboxgl-popup').remove();
                });
            })

            //light-v10, outdoors-v11, satellite-v9, streets-v11, dark-v10
            const style = "dark-v10"
            map.setStyle(`mapbox://styles/mapbox/${style}`);

            const getLongLatByMarker = () => {
                const lngLat = marker.getLngLat();
                return 'Longitude: ' + lngLat.lng + '<br />Latitude: ' + lngLat.lat;
            }

            map.on('click', (e) => {
                if (@this.isEdit) {
                    return
                } else {
                    coordinateInfo.innerHTML = JSON.stringify(e.point) + '<br />' + JSON.stringify(e.lngLat
                        .wrap());
                    @this.long = e.lngLat.lng;
                    @this.lat = e.lngLat.lat;
                }
            });
        })
    </script>
@endpush --}}
