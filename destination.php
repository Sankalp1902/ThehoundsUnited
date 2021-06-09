<!DOCTYPE html>
<html class='use-all-space'>
<head>
    <meta http-equiv='X-UA-Compatible' content='IE=Edge' />
    <meta charset='UTF-8'>
    <title>Maps SDK for Web - Search with autocomplete</title>
    <meta name='viewport'
          content='width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no'/>
    <link rel='stylesheet' type='text/css' href='https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.53.0/maps/maps.css'>
    <link rel='stylesheet' type='text/css' href='assets/ui-library/index.css'/>
        <link rel='stylesheet' type='text/css' href='https://api.tomtom.com/maps-sdk-for-web/cdn/plugins/SearchBox/2.2.0//SearchBox.css'/>
    <link rel='stylesheet' type='text/css' href='https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.53.0/maps/css-styles/poi.css'/>
    <link rel='stylesheet' type='text/css' href='https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.53.0/maps/css-styles/traffic-incidents.css'/>
    <link rel='stylesheet' type='text/css' href='https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.53.0/maps/css-styles/routing.css'/>
<script>
            alert('Please enter your destination');            
            </script>            
</head>
<body>
    <div class='map-view'>
        <div class='tt-side-panel'>
            <header class='tt-side-panel__header'>
            </header>
            <div class='tt-tabs js-tabs'>
                <div class='tt-tabs__panel'>
                    <div class='js-results' hidden='hidden'></div>
                    <div class='js-results-loader' hidden='hidden'>
                        <div class='loader-center'><span class='loader'></span></div>
                    </div>
                    <div class='tt-tabs__placeholder js-results-placeholder'></div>
                </div>
            </div>
        </div>
        <div id='map' class='full-map'></div>
    </div>
    <script>
            alert('Project still under development, please visit "thehoundsunited.000webhostapp.com" after sometime to check it fully working');            
            </script>
    <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.53.0/maps/maps-web.min.js"></script>
    <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.53.0/services/services-web.min.js"></script>
    <script src='https://api.tomtom.com/maps-sdk-for-web/cdn/plugins/SearchBox/2.2.0//SearchBox-web.js'></script>
    <script data-showable type='text/javascript' src='assets/js/search-markers/search-marker.js'></script>
    <script data-showable type='text/javascript' src='assets/js/search/search-results-parser.js'></script>
    <script data-showable type='text/javascript' src='assets/js/search-markers/search-markers-manager.js'></script>
    <script data-showable type='text/javascript' src='assets/js/info-hint.js'></script>
    <script data-showable type='text/javascript' src='assets/js/mobile-or-tablet.js'></script>
    <script data-showable type='text/javascript' src='assets/js/search/results-manager.js'></script>
    <script data-showable type='text/javascript' src='assets/js/search/side-panel.js'></script>
    <script data-showable type='text/javascript' src='assets/js/search/dom-helpers.js'></script>
    <script data-showable type='text/javascript' src='assets/js/formatters.js'></script>
    <script>
        tt.setProductInfo('thehoundsunited', '1.0');

        navigator.geolocation.getCurrentPosition((position) => {
        	const latitude  = position.coords.latitude;
  			const longitude = position.coords.longitude;  
		});

        var map = tt.map({
            key: '57NbLt5SDV09G7Gw6gaOCw8VPNteWURM',
            container: 'map',
            center: [26, 80],
            zoom: 7,
            style: 'tomtom://vector/1/basic-main',
            dragPan: !window.isMobileOrTablet()
        });

        var infoHint = new InfoHint('info', 'bottom-center', 5000).addTo(document.getElementById('map'));
        var errorHint = new InfoHint('error', 'bottom-center', 5000).addTo(document.getElementById('map'));

        // Options for the fuzzySearch service
        var searchOptions = {
            key: '57NbLt5SDV09G7Gw6gaOCw8VPNteWURM',
            language: 'en-Gb',
            limit: 5
        };

        // Options for the autocomplete service
        var autocompleteOptions = {
            key: '57NbLt5SDV09G7Gw6gaOCw8VPNteWURM',
            language: 'en-Gb'
        };

        var searchBoxOptions = {
            minNumberOfCharacters: 0,
            searchOptions: searchOptions,
            autocompleteOptions: autocompleteOptions
        };
        var ttSearchBox = new tt.plugins.SearchBox(tt.services, searchBoxOptions);
        document.querySelector('.tt-side-panel__header').appendChild(ttSearchBox.getSearchBoxHTML());

        var state = {
            previousOptions: {
                query: null,
                center: null
            },
            callbackId: null
        };

        map.addControl(new tt.FullscreenControl());
        map.addControl(new tt.NavigationControl());
        new SidePanel('.tt-side-panel', map);
        var resultsManager = new ResultsManager();
        var searchMarkersManager = new SearchMarkersManager(map);

        map.on('load', handleMapEvent);
        map.on('moveend', handleMapEvent);

        ttSearchBox.on('tomtom.searchbox.resultscleared', handleResultsCleared);
        ttSearchBox.on('tomtom.searchbox.resultsfound', handleResultsFound);
        ttSearchBox.on('tomtom.searchbox.resultfocused', handleResultSelection);
        ttSearchBox.on('tomtom.searchbox.resultselected', handleResultSelection);

        function handleMapEvent() {
            // Update search options to provide geobiasing based on current map center
            var oldSearchOptions = ttSearchBox.getOptions().searchOptions;
            var oldautocompleteOptions = ttSearchBox.getOptions().autocompleteOptions;
            var newSearchOptions = Object.assign({}, oldSearchOptions, { center: map.getCenter() });
            var newAutocompleteOptions = Object.assign({}, oldautocompleteOptions, { center: map.getCenter() });
            ttSearchBox.updateOptions(Object.assign(
                {},
                searchBoxOptions,
                { searchOptions: newSearchOptions },
                { autocompleteOptions: newAutocompleteOptions }
            ));
        }

        function handleResultsCleared() {
            searchMarkersManager.clear();
            resultsManager.clear();
        }

        function handleResultsFound(event) {
            // Display fuzzySearch results if request was triggered by pressing enter
            if (event.data.results && event.data.results.fuzzySearch && event.data.metadata.triggeredBy === 'submit') {
                var results = event.data.results.fuzzySearch.results;

                if (results.length === 0) {
                    handleNoResults();
                }
                searchMarkersManager.draw(results);
                resultsManager.success();
                fillResultsList(results);
                fitToViewport(results);
            }

            if (event.data.errors) {
                errorHint.setMessage('There was an error returned by the service.');
            }
        }

        function handleResultSelection(event) {
            if (isFuzzySearchResult(event)) {
                // Display selected result on the map
                var result = event.data.result;
                resultsManager.success();
                searchMarkersManager.draw([result]);
                fillResultsList([result]);
                searchMarkersManager.openPopup(result.id);
                fitToViewport(result);
                state.callbackId = null;
                infoHint.hide();
            } else if (stateChangedSinceLastCall(event)) {
                var currentCallbackId = Math.random().toString(36).substring(2, 9);
                state.callbackId = currentCallbackId;
                // Make fuzzySearch call with selected autocomplete result as filter
                handleFuzzyCallForSegment(event, currentCallbackId);
            }
        }

        function isFuzzySearchResult(event) {
            return !('matches' in event.data.result);
        }

        function stateChangedSinceLastCall(event) {
            return Object.keys(searchMarkersManager.getMarkers()).length === 0 || !(
                state.previousOptions.query === event.data.result.value &&
                state.previousOptions.center.toString() === map.getCenter().toString());
        }

        function getBounds(data) {
            var btmRight;
            var topLeft;
            if (data.viewport) {
                btmRight = [data.viewport.btmRightPoint.lng, data.viewport.btmRightPoint.lat];
                topLeft = [data.viewport.topLeftPoint.lng, data.viewport.topLeftPoint.lat];
            }
            return [btmRight, topLeft];
        }

        function fitToViewport(markerData) {
            if (!markerData || markerData instanceof Array && !markerData.length) {
                return;
            }
            var bounds = new tt.LngLatBounds();
            if (markerData instanceof Array) {
                markerData.forEach(function(marker) {
                    bounds.extend(getBounds(marker));
                });
            } else {
                bounds.extend(getBounds(markerData));
            }
            map.fitBounds(bounds, { padding: 100, linear: true });
        }

        function handleFuzzyCallForSegment(event, currentCallbackId) {
            var query = ttSearchBox.getValue();
            var segmentType = event.data.result.type;

            var commonOptions = Object.assign({}, searchOptions, {
                query: query,
                limit: 15,
                center: map.getCenter(),
                typeahead: true
            });

            var filter;
            if (segmentType === 'category') {
                filter = { categorySet: event.data.result.id };
            }
            if (segmentType === 'brand') {
                filter = { brandSet: event.data.result.value };
            }
            var options = Object.assign({}, commonOptions, filter);

            infoHint.setMessage('Loading results...');
            errorHint.hide();
            resultsManager.loading();
            tt.services.fuzzySearch(options)
                .go()
                .then(function(response) {
                    if (state.callbackId !== currentCallbackId) {
                        return;
                    }
                    if (response.results.length === 0) {
                        handleNoResults();
                        return;
                    }
                    resultsManager.success();
                    searchMarkersManager.draw(response.results);
                    fillResultsList(response.results);
                    map.once('moveend', function() {
                        state.previousOptions = {
                            query: query,
                            center: map.getCenter()
                        };
                    });
                    fitToViewport(response.results);
                })
                .catch(function(error) {
                    if (error.data && error.data.errorText) {
                        errorHint.setMessage(error.data.errorText);
                    }
                    resultsManager.resultsNotFound();
                })
                .finally(function() {
                    infoHint.hide();
                });
        }

        function handleNoResults() {
            resultsManager.clear();
            resultsManager.resultsNotFound();
            searchMarkersManager.clear();
            infoHint.setMessage(
                'No results for "' +
                ttSearchBox.getValue() +
                '" found nearby. Try changing the viewport.'
            );
        }

        function fillResultsList(results) {
            resultsManager.clear();
            var resultList = DomHelpers.createResultList();
            results.forEach(function(result) {
                var distance = SearchResultsParser.getResultDistance(result);
                var searchResult = DomHelpers.createSearchResult(
                    SearchResultsParser.getResultName(result),
                    SearchResultsParser.getResultAddress(result),
                    distance ? Formatters.formatAsMetricDistance(distance) : ''
                );
                var resultItem = DomHelpers.createResultItem();
                resultItem.appendChild(searchResult);
                resultItem.setAttribute('data-id', result.id);
                resultItem.onclick = function(event) {
                    var id = event.currentTarget.getAttribute('data-id');
                    searchMarkersManager.openPopup(id);
                    searchMarkersManager.jumpToMarker(id);
                };
                resultList.appendChild(resultItem);
            });
            resultsManager.append(resultList);
        }
    </script>
</body>
</html>
