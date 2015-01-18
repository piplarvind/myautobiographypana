// Copyright 2012 Omar AL Zabir
// Part of Droptiles project.
// This file holds the definition of tiles and which tiles appear by default 
// to new visitors. 


// The default tile setup offered to new users.
window.DefaultTiles = [
    {
           name :"Section1",
        tiles: [
           	{ id: "flickr1", name:"flickr" },
			{ id: "newsrender1", name:"newsrender" },
			{ id: "calender1", name:"calender" },
			{ id: "clickedit1", name:"clickedit" },
	  		{ id: "dr1", name: "dr" },
			{ id: "social1", name: "social" },
			
        ]
    },
    {
        name: "Section2",
        tiles: [
       
		  { id: "pb1", name: "pb" },
		  { id: "ib1", name: "ib" },
		  { id: "feature1", name: "feature" } ,
		  { id: "featuresec1", name: "featuresec" } ,
		]
    },
    {
        name: "Section3", tiles: [
            
           { id: "howto1", name: "howto" }               
        ]
    }
];


// Convert it to a serialized string
window.DefaultTiles = _.map(window.DefaultTiles, function (section) {
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
           tileImage: "img/timeline-img.png",
            size: "tile-double flickr-height",
            color: "bg-color-darken",
            appUrl: "Tiles/Flickr/App/FlickrApp.html",
            cssSrc: ["tiles/flickr/flickr.css"],
            scriptSrc: ["tiles/flickr/flickr.js?v=1"],
            //scriptSrc: ["tiles/flickr/flickr_interesting.js"],
            //cssSrc: ["tiles/flickr/flickr_interesting.css"],            
            initFunc: "flickr_load"
        };
    },
	newsrender: function (uniqueId) {
        return {
            uniqueId: uniqueId,
            name: "newsrender",
            iconSrc: "img/Rss.jpg",
            size: "tile",
            color: "bg-color-darken",
            appUrl: "Tiles/newrender/App/FlickrApp.html",
            cssSrc: ["tiles/newrender/flickr.css"],
            scriptSrc: ["tiles/newrender/flickr.js?v=1"],
            //scriptSrc: ["tiles/flickr/flickr_interesting.js"],
            //cssSrc: ["tiles/flickr/flickr_interesting.css"],            
            initFunc: "flickr_load"
        };
    },
		
	 calender: function (uniqueId) {
        return {
            uniqueId: uniqueId,
            name: "calender",
            iconSrc: "img/Calender.jpg",
            size: "tile",
            color: "bg-color-darken",
            appUrl: "Tiles/calender/App/FlickrApp.html",
            cssSrc: ["tiles/calender/flickr.css"],
            scriptSrc: ["tiles/calender/flickr.js?v=1"],
            //scriptSrc: ["tiles/flickr/flickr_interesting.js"],
            //cssSrc: ["tiles/flickr/flickr_interesting.css"],            
            initFunc: "flickr_load"
        };
    },
	clickedit: function (uniqueId) {
        return {
            uniqueId: uniqueId,
            name: "clickedit",
            iconSrc: "img/propf-pic.png",        
			size: "click-width",
           	color: "bg-color-purple",
            //appUrl: "http://192.168.2.24:8080/P903/rasika/p903/tiles/DR/DR.html",
			slidesFrom: ["tiles/click-edit/click-edit.html"]
        };
    },
   
   
 dr: function (uniqueId) {
        return {
            uniqueId: uniqueId,
            name: "dr",
            iconSrc: "img/digi-img.png",
			color: "bg-color-purple",
 			size: "tiles-width tiles-height",
            //appUrl: "http://192.168.2.24:8080/P903/rasika/p903/tiles/DR/DR.html",
			slidesFrom: ["tiles/digital-record/digital-record.html"]
        };
    },
	
	social: function (uniqueId) {
        return {
            uniqueId: uniqueId,
            name: "social",
            iconSrc: "img/social.png",
			size: "social-width",
         	color: "bg-color-purple",
            //appUrl: "http://192.168.2.24:8080/P903/rasika/p903/tiles/DR/DR.html",
			slidesFrom: ["tiles/social/social.html"]
        };
    },
	
	 pb: function (uniqueId) {
        return {
            uniqueId: uniqueId,
            name: "pb",
            iconSrc: "img/personal-img.png",
			size: "browni-width tile-triple-vertical",
           	color: "bg-color-purple",
           // appUrl: "http://192.168.2.24:8080/P903/rasika/p903/tiles/DR/DR.html",
			slidesFrom: ["tiles/personal-browni/personal-browni.html"]
        };
    },
	 ib: function (uniqueId) {
        return {
            uniqueId: uniqueId,
            name: "ib",
            iconSrc: "img/insiti-img.png",        
			size: "browni-width tile-triple-vertical",
           	color: "bg-color-purple",
            //appUrl: "http://192.168.2.24:8080/P903/rasika/p903/tiles/DR/DR.html",
			slidesFrom: ["tiles/insititue-browni/insititute-browni.html"]
        };
    },
	
	
    feature: function (uniqueId) {
        return {
            uniqueId: uniqueId,
            name: "feature",
            color: "bg-color-green",
            size: "tile-double news-height desc-tile",
            appUrl: "http://oazabir.github.com/Droptiles/",
            slidesFrom: ["tiles/features/feature1.html",
                "tiles/features/feature2.html",
                "tiles/features/feature3.html"],
            cssSrc: ["tiles/features/features.css"]
        };
    },

  featuresec: function (uniqueId) {
        return {
            uniqueId: uniqueId,
            name: "featuresec",
            color: "bg-color-green",
            size: "tile-double news-height desc-tile",
            appUrl: "http://oazabir.github.com/Droptiles/",
            slidesFrom: ["tiles/features/feature1.html",
                "tiles/features/feature2.html",
                "tiles/features/feature3.html"],
            cssSrc: ["tiles/features/features.css"]
        };
    },
        
        
};
