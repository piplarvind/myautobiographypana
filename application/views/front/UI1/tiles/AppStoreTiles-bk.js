// Copyright 2012 Omar AL Zabir
// Part of Droptiles project.
// This file holds the definition of tiles and the tiles to show on the App Store.


// The default tile setup offered to new users.
window.AppStoreTiles = [
    {
        name: "Spotlight",
        tiles: [
           { id: "flickr1", name:"flickr" },
           { id: "angrybirds1", name: "angrybirds" },
           { id: "cuttherope1", name: "cutTheRope" }           
        ]
    },
    {
        name: "Tools",
        tiles: [
           { id: "youtube1", name: "youtube" },
           { id: "amazon1", name: "amazon" },
           { id: "library1", name: "library" },
           { id: "news1", name: "news" },
           { id: "weather1", name: "weather" }
           
        ]
    },
    {
        name: "Games",
        tiles: [
           { id: "angrybirds2", name: "angrybirds" },
           { id: "cuttherope2", name: "cutTheRope" }   
        ]
    }    
];


// Convert it to a serialized string
window.AppStoreTiles = _.map(window.AppStoreTiles, function (section) {
    return "" + section.name + "~" + (_.map(section.tiles, function (tile) {
        return "" + tile.id + "," + tile.name;
    })).join(".");
}).join("|");
        

// Definition of the tiles, their default values.
window.TileBuilders = {

    flickr: function (uniqueId) {
        return {
            uniqueId: uniqueId,
            name: "flickr",

            size: 'tile-double flickr-height tile-triple-vertical',
            tileImage: 'img/timeline-img.png'
        };
    },
	  newsrender: function (uniqueId) {
        return {
            uniqueId: uniqueId,
            name: "newsrender",
            size: 'tile',
            tileImage: 'img/Rss.jpg'
        };
    },
	  calender: function (uniqueId) {
        return {
            uniqueId: uniqueId,
            name: "calender",
            size: 'tile',
            tileImage: 'img/Calender.jpg'
        };
    },
	 clickedit: function (uniqueId) {
        return {
            uniqueId: uniqueId,
            name: "ib",
            size: "click-width",
            tileImage: 'img/propf-pic.png'        
        };
    },

	dr: function (uniqueId) {
        return {
            uniqueId: uniqueId,
            name: "dr",
            size: "tiles-width tiles-height",
            tileImage: 'img/digi-img.png'
        };
    },
	
	pb: function (uniqueId) {
        return {
            uniqueId: uniqueId,
            name: "pb",
           size: "browni-width tile-triple-vertical",
            tileImage: 'img/personal-img.png'
        };
    },
	
	ib: function (uniqueId) {
        return {
            uniqueId: uniqueId,
            name: "ib",
             size: "browni-width tile-triple-vertical",
            tileImage: 'img/insiti-img.png'
        };
    },
	social: function (uniqueId) {
        return {
            uniqueId: uniqueId,
            name: "social",
             size: "social-width",
            tileImage: 'img/social.png'
        };
    },

    feature: function (uniqueId) {
        return {
            uniqueId: uniqueId,
            name: "feature"   
        };
    },

  featuresec: function (uniqueId) {
        return {
            uniqueId: uniqueId,
            name: "featuresec"   
        };
    },

 };
