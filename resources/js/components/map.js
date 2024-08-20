import {Map, View} from 'ol';
import TileLayer from 'ol/layer/Tile';
import OSM from 'ol/source/OSM';
import {fromLonLat} from 'ol/proj.js';
import Feature from 'ol/Feature';
import VectorSource from 'ol/source/Vector';
import VectorLayer from 'ol/layer/Vector';
import Geometry from 'ol/geom/Geometry.js';
import Point from 'ol/geom/Point';
import {Icon,Fill, Stroke, Circle, Text, Style} from 'ol/style.js';

var my_map = {                       // <-- add this line to declare the object
    display: function () {           // <-- add this line to declare a method

        const map = new Map({
            target: 'map',
            layers: [
                new TileLayer({
                    source: new OSM()
                })
            ],
            view: new View({
                projection: 'EPSG:3857',
                center: fromLonLat([120.933762, 23.893032]),
                zoom: 8
            }),
        });
        const position_array = [
            new Feature({
                geometry: new Point(fromLonLat([121.5330570, 24.2083680])),
                name: '鍛鍊山',
            }),
            new Feature({
                geometry:new Point (fromLonLat([121.439359, 24.361805])),
                name: '南湖大山',
            }),
            new Feature({
                geometry:new Point (fromLonLat([121.17844, 24.50726])),
                name: '結城山',
            }),
        ];


        for (var i = 0; i < position_array.length; i++) {
            const marker = new VectorLayer({
                source: new VectorSource({
                    features: [position_array[i],],
                }),
                style: new Style({
                    image: new Icon({
                        src: "assets/img/favicon.png",
                    }),
                    text: new Text({
                        font: '20px 微軟正黑體',
                        textAlign: 'left',
                        text: position_array[i].get('name'),
                        offsetY: -15,
                        offsetX: 5,
                        backgroundFill: new Fill({
                            color: 'rgba(255, 255, 255, 0.5)',
                        }),
                        backgroundStroke: new Stroke({
                            color: 'rgba(227, 227, 227, 1)',
                        }),
                        padding: [5, 2, 2, 5]
                    }),
                })
            })
            map.addLayer(marker);
        }

    }                                // <-- close the method
};                                   // <-- close the object
export default my_map;               // <-- and export the object
