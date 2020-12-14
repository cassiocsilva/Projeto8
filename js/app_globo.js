$(document).ready(function() {
  "use strict";

  /**
   * The Globe encapsulates the WorldWindow object (wwd) and provides application
   * specific logic for interacting with layers.
   * @param {String} canvasId The ID of the canvas element that will host the globe
   * @returns {Globe}
   */
  class Globe {
    constructor(canvasId) {
      // Create a WorldWindow globe on the specified HTML5 canvas
      this.wwd = new WorldWind.WorldWindow(canvasId);

      // Holds the next unique id to be assigned to a layer
      this.nextLayerId = 1;

      // Add a BMNGOneImageLayer background layer. We're overriding the default 
      // minimum altitude of the BMNGOneImageLayer so this layer always available.
      this.addLayer(new WorldWind.BingRoadsLayer(), {
        category: "background",
        minActiveAltitude: 0
      });
      
      
      
// Get a reference to the WorldWindow.
//var wwd = ...

// Adjust the Navigator to place Alaska in the center of the
// WorldWindow.
this.wwd.navigator.lookAtLocation.latitude = -23.2903; // -23.2903
this.wwd.navigator.lookAtLocation.longitude = -47.2963; // -47.2963
this.wwd.navigator.range = 18906000; // 2 million meters above the ellipsoid

// Redraw the WorldWindow.
this.wwd.redraw();
      
      
      
      
    }

    /**
     * Adds a layer to the globe. Applies the optional options' properties to the
     * layer, and assigns the layer a unique ID and category.
     * @param {WorldWind.Layer} layer
     * @param {Object|null} options E.g., {category: "base", enabled: true}
     */
    addLayer(layer, options) {
      // Copy all properties defined on the options object to the layer
      if (options) {
        for (let prop in options) {
          if (!options.hasOwnProperty(prop)) {
            continue; // skip inherited props
          }
          layer[prop] = options[prop];
        }
      }
      // Assign a default category property if not already assigned
      if (typeof layer.category === 'undefined') {
        layer.category = 'overlay'; // the default category
      }

      // Assign a unique layer ID to ease layer management 
      layer.uniqueId = this.nextLayerId++;

      // Add the layer to the globe
      this.wwd.addLayer(layer);
    }

    /**
     * Returns a new array of layers in the given category.
     * @param {String} category E.g., "base", "overlay" or "setting".
     * @returns {Array}
     */
    getLayers(category) {
      return this.wwd.layers.filter(layer => layer.category === category);
    }
  }

  // Create a globe
  let globe = new Globe("globe-canvas");

  // Add layers to the globe 
  globe.addLayer(new WorldWind.BingRoadsLayer(), {
    category: "base"
  });
  globe.addLayer(new WorldWind.CoordinatesDisplayLayer(globe.wwd), {
    category: "setting"
  });
  globe.addLayer(new WorldWind.ViewControlsLayer(globe.wwd), {
    category: "setting"
  });
  globe.addLayer(new WorldWind.CompassLayer(), {
    category: "setting",
    enabled: false
  });


  // Auto-collapse the main menu when its button items are clicked
  $('.navbar-collapse a[role="button"]').click(function() {
    $('.navbar-collapse').collapse('hide');
  });

  // Collapse card ancestors when the close icon is clicked
  $('.collapse .close').on('click', function() {
    $(this).closest('.collapse').collapse('hide');
  });
});
