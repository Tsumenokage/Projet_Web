var map = {
	initProperties : function(){
	
		this.map;
		this.trajectory;
		this.marker;
		var latitudeMin        = 44.825746;
		var longitudeMin       = -0.854663;
		var latitudeMax        = 45.077561;
		var longitudeMax       = -0.69451;
		
		this.options = {
			projection          : new OpenLayers.Projection('EPSG:900913'),
			displayProjection   : new OpenLayers.Projection('EPSG:4326'),
			units               : 'm',
			maxResolution       : 156543.0339,
			maxExtent           : new OpenLayers.Bounds(-20037508.34, -20037508.34,
														 20037508.34, 20037508.34)
		};
		
	
	},
	
	init : function(){
		
		console.log('init');
		
		this.initProperties();
		this.map    = new OpenLayers.Map('map', this.options);
	
		var mapnik  = new OpenLayers.Layer.TMS('OpenStreetMap (Mapnik)', 'http://tile.openstreetmap.org/',
			{
				type                    : 'png', getURL: osm_getTileURL,
				displayOutsideMaxExtent : true,
				attribution             : '<a href="http://www.openstreetmap.org/">OpenStreetMap</a>'
			}
		);
		this.map.addLayer(mapnik);
		
		this.layer_style = OpenLayers.Util.extend({}, OpenLayers.Feature.Vector.style['default']);
		this.layer_style.fillOpacity = 0.2;
		this.layer_style.graphicOpacity = 1;
		
		this.setCenter(-0.60,44);//Center on Paris!
		
	},
	
	/**
		 * addTrajectory
		 *
		 * @brief add an object Trajectory to the map
		 *
		 * @param string name The name of the trajectory
		 * @param list style The style of the trajectory
		 * 
		 * 
		 * EXAMPLE of style (this is the default style if style is null:  
		 * 	var defaultStyle = {
			strokeColor: '#CC0000',
			strokeWidth: 3,
			strokeDashstyle: 'plain',
			pointRadius: 6,
			pointerEvents: 'visiblePainted'
			};            
		 */
	addTrajectory: function(name, style){
		
		this.trajectory = new Trajectory(name,style);
		
		this.map.addLayer(this.trajectory.layer);
	},

		/**
		 * trajectoryAddPoint
		 *
		 * @brief add a point to the map trajectory
		 *
		 * @param float longitude The longitude of the point to insert
		 * @param float latitude The latitude of the point to insert
		 *  
		 */
	trajectoryAddPoint: function(longitude, latitude){
		
		this.trajectory.addPoint(this.map,longitude,latitude);
		
		this.trajectory.layer.refresh();//May be useless
		console.log('Refresh?')
		this.setCenter(longitude, latitude);
	},

	setCenter: function(longitude, latitude){
		var point = new OpenLayers.Geometry.Point(longitude, latitude).transform(this.map.displayProjection, this.map.projection);
		this.map.setCenter(new OpenLayers.LonLat(point.x, point.y), 5);
	},

	destroy: function(){
		this.map.destroy();
	}


}
map = Class.extend(map);
