/*
  Serverless 3D Minecraft Skin
  Copyright (c) 2014, James Mortemore <jamesmortemore@gmail.com>
  Permission to use, copy, modify, and/or distribute this software for any purpose with or without fee is
  hereby granted, provided that the above copyright notice and this permission notice appear in all copies.

  THE SOFTWARE IS PROVIDED "AS IS" AND THE AUTHOR DISCLAIMS ALL WARRANTIES WITH REGARD TO THIS SOFTWARE
  INCLUDING ALL IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS. IN NO EVENT SHALL THE AUTHOR BE LIABLE
  FOR ANY SPECIAL, DIRECT, INDIRECT, OR CONSEQUENTIAL DAMAGES OR ANY DAMAGES WHATSOEVER RESULTING FROM LOSS
  OF USE, DATA OR PROFITS, WHETHER IN AN ACTION OF CONTRACT, NEGLIGENCE OR OTHER TORTIOUS ACTION, ARISING
  OUT OF OR IN CONNECTION WITH THE USE OR PERFORMANCE OF THIS SOFTWARE.

  Based on minecraft skins in html5 canvas tags by Kent Rasmussen @ earthiverse.ath.cx
 */

(function($) {
  var pluginName = 'minecraftSkin'
  /* jslint maxlen: 2414 */
    , steveImg = 'default.png'

  var methods =
    { init: function(options) {
      return this.each(function () {
        var $this = $(this)
          , data = $this.data(pluginName)
          , settings = {}

        // If the plugin hasn't been initialized yet
        if (!data) {
          settings =
            { scale: 6
            , hat: true
            , draw : 'model'
            , skinsrequest: 'http://localhost/skins'
            }

          if(options) $.extend(true, settings, options)
        }

        settings.username = $this.data('minecraft-username')

        if ($this.data('minecraft-scale')) settings.scale = $this.data('minecraft-scale')
        if ($this.data('minecraft-draw')) settings.draw = $this.data('minecraft-draw')

        // Check if valid drawing set
        if (settings.draw !== 'head' && settings.draw !== 'model') settings.draw = 'model'

        // Request the data
        methods.requestData(settings.skinsrequest + settings.username + '.png', $this, settings)
      })
    }
    , buildImage: function(imgData, $this, settings) {
      // Failed to respond
      if(!imgData) return

      // Create the canvas
      var canvas = document.createElement('canvas')
        , scratchCanv = document.createElement('canvas')
        , model = canvas.getContext('2d')
        , scratch = scratchCanv.getContext('2d')
        , skin = new Image()
        , heightMultiplier = settings.draw === 'head' ? 17.6 : 44.8

      canvas.setAttribute('class', 'model')

      // Resize Scratch
      scratchCanv.setAttribute('width', 64 * settings.scale)
      scratchCanv.setAttribute('height', 32 * settings.scale)
      scratchCanv.setAttribute('class', 'scratch')

      // Resize Isometric Area (Found by trial and error)
      canvas.setAttribute('width', 20 * settings.scale)
      canvas.setAttribute('height', heightMultiplier * settings.scale)

      $this.append(canvas)
      $this.append(scratchCanv)

      skin.onload = function () {
        scratch.drawImage(skin, 0, 0, 64, 32, 0, 0, 64, 32)

        // Scale it
        scaleImage(scratch.getImageData(0, 0, 64, 32), scratch, 0, 0, settings.scale)

        // Draw the skin
        if(settings.draw === 'model') {
          methods.drawModel(model, scratchCanv, scratch, settings.hat, settings.scale)
        } else {
          methods.drawHead(model, scratchCanv, scratch, settings.hat, settings.scale)
        }
      }

      skin.src = imgData
    }
    , requestData: function(username, $this, settings) {
		$.ajax({
		  type: 'HEAD',
		  url: username,
		  success: function() {
		    methods.buildImage(username, $this, settings)
		  },
		  error: function() {
		    methods.buildImage(settings.skinsrequest + steveImg, $this, settings)
		  }
	    });
      }
    , drawHead: function (model, scratchCanv, scratch, showHat, scale) {
        var scaleEight = 8 * scale
        // Head - Front
        model.setTransform(1, -0.5, 0, 1.2, 0, 0)
        model.drawImage
          ( scratchCanv
          , scaleEight
          , scaleEight
          , scaleEight
          , scaleEight
          , 10 * scale
          , 13/1.2 * scale
          , scaleEight
          , scaleEight
          )

        // Head - Right
        model.setTransform(1, 0.5, 0, 1.2, 0, 0)
        model.drawImage
          ( scratchCanv
          , 0
          , scaleEight
          , scaleEight
          , scaleEight
          , 2 * scale
          , 3/1.2 * scale
          , scaleEight
          , scaleEight
          )

        // Head - Top
        model.setTransform(-1, 0.5, 1, 0.5, 0, 0)
        model.scale(-1, 1)
        model.drawImage
          ( scratchCanv
          , scaleEight
          , 0
          , scaleEight
          , scaleEight
          , -3 * scale
          , 5 * scale
          , scaleEight
          , scaleEight
          )

        if (!showHat) return

        // Hat - Front
        model.setTransform(1, -0.5, 0, 1.2, 0, 0)
        model.drawImage
          ( scratchCanv
          , 40 * scale
          , scaleEight
          , scaleEight
          , scaleEight
          , 10 * scale
          , 13/1.2 * scale
          , scaleEight
          , scaleEight
          )

        // Hat - Right
        model.setTransform(1, 0.5, 0, 1.2, 0, 0)
        model.drawImage
          ( scratchCanv
          , 32 * scale
          , scaleEight
          , scaleEight
          , scaleEight
          , 2 * scale
          , 3/1.2 * scale
          , scaleEight
          , scaleEight
          )

        // Hat - Top
        model.setTransform(-1, 0.5, 1, 0.5, 0, 0)
        model.scale(-1, 1)
        model.drawImage
          ( scratchCanv
          , 40 * scale
          , 0
          , scaleEight
          , scaleEight
          , -3 * scale
          , 5 * scale
          , scaleEight
          , scaleEight
          )
      }
    , drawModel: function(model, scratchCanv, scratch, showHat, scale) {
        var scaleEight = 8 * scale

        // Left Leg
        // Left Leg - Front
        model.setTransform(1, -0.5, 0, 1.2, 0, 0)
        model.scale(-1, 1)
        model.drawImage
          ( scratchCanv
          , 4 * scale
          , 20 * scale
          , 4 * scale
          , 12 * scale
          , -16 * scale
          , 34.4/1.2 * scale
          , 4 * scale
          , 12 * scale
          )

        // Right Leg
        // Right Leg - Right
        model.setTransform(1, 0.5, 0, 1.2, 0, 0)
        model.drawImage
          ( scratchCanv
          , 0 * scale
          , 20 * scale
          , 4 * scale
          , 12 * scale
          , 4 * scale
          , 26.4/1.2 * scale
          , 4 * scale
          , 12 * scale
          )

        // Right Leg - Front
        model.setTransform(1, -0.5 ,0, 1.2, 0, 0)
        model.drawImage
          ( scratchCanv
          , 4 * scale
          , 20 * scale
          , 4 * scale
          , 12 * scale
          , 8 * scale
          , 34.4/1.2 * scale
          , 4 * scale
          , 12 * scale
          )

        // Arm Left
        // Arm Left - Front
        model.setTransform(1, -0.5, 0, 1.2, 0, 0)
        model.scale(-1, 1)
        model.drawImage
          ( scratchCanv
          , 44 * scale
          , 20 * scale
          , 4 * scale
          , 12 * scale
          , -20 * scale
          , 20/1.2 * scale
          , 4 * scale
          , 12 * scale
          )

        // Arm Left - Top
        model.setTransform(-1, 0.5, 1, 0.5, 0, 0)
        model.drawImage
          ( scratchCanv
          , 44 * scale
          , 16 * scale
          , 4 * scale
          , 4 * scale
          , 0
          , 16 * scale
          , 4 * scale
          , 4 * scale
          )

        // Body
        // Body - Front
        model.setTransform(1, -0.5, 0, 1.2, 0, 0)
        model.drawImage
          ( scratchCanv
          , 20 * scale
          , 20 * scale
          , 8 * scale
          , 12 * scale
          , 8 * scale
          , 20/1.2 * scale
          , scaleEight
          , 12 * scale
          )

        // Arm Right
        // Arm Right - Right
        model.setTransform(1, 0.5, 0, 1.2, 0, 0)
        model.drawImage
          ( scratchCanv
          , 40 * scale
          , 20 * scale
          , 4 * scale
          , 12 * scale
          , 0
          , 16/1.2 * scale
          , 4 * scale
          , 12 * scale
          )

        // Arm Right - Front
        model.setTransform(1, -0.5, 0, 1.2, 0, 0)
        model.drawImage
          ( scratchCanv
          , 44 * scale
          , 20 * scale
          , 4 * scale
          , 12 * scale
          , 4 * scale
          , 20/1.2 * scale
          , 4 * scale
          , 12 * scale
          )

        // Arm Right - Top
        model.setTransform(-1, 0.5, 1, 0.5, 0, 0)
        model.scale(-1 ,1)
        model.drawImage
          ( scratchCanv
          , 44 * scale
          , 16 * scale
          , 4 * scale
          , 4 * scale
          , -16 * scale
          , 16 * scale
          , 4 * scale
          , 4 * scale
          )

        methods.drawHead(model, scratchCanv, scratch, showHat, scale)
      }

  }

  //Scales using nearest neighbour
  function scaleImage(imageData, context, dx, dy, scale) {
    var width = imageData.width
      , height = imageData.height

    context.clearRect(0, 0, width, height) //Clear the spot where it originated from

    for (var y = 0; y < height; y++) { // Height original
      for (var x = 0; x < width; x++) { // Width original
        // Gets original colour, then makes a scaled square of the same colour
        var index = (x + y * width) * 4
          , fill = imageData.data[index]

        fill += ',' + imageData.data[index + 1] + ',' + imageData.data[index + 2] + ',' + imageData.data[index + 3]

        context.fillStyle = 'rgba(' + fill + ')'
        context.fillRect(dx + x * scale, dy + y * scale, scale, scale)
      }
    }
  }

  $.fn[pluginName] = function( method ) {
    if (methods[method]) {
      return methods[method].apply( this, Array.prototype.slice.call( arguments, 1 ))
    } else if (typeof method === 'object' || !method) {
      return methods.init.apply(this, arguments)
    } else {
      $.error('Method ' + method + ' does not exist in jQuery.' + pluginName)
    }
  }
})( jQuery )
