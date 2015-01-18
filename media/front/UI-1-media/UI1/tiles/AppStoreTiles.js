// Copyright 2012 Omar AL Zabir
// Part of Droptiles project.
// This file holds the definition of tiles and the tiles to show on the App Store.

 var base_path = $("#base_path").val();
 var base_url = $("#base_url").val();
 
// The default tile setup offered to new users.
window.AppStoreTiles = [
    {
        name :"Ready to go on your dashboard",
        tiles: [
                 { id: "social1", name: "social" },
           	 { id: "newsrender1", name:"newsrender" },
		 { id: "calender1", name:"calender" }  
        ]
    },
    {
         name: "Comming soon",
        tiles: [
	           { id: "mygaming1", name: "mygaming" },
		   { id: "mymusic1", name: "mymusic" },
		   { id: "myvideo1", name: "myvideo" },
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

    social: function (uniqueId) {
        return {
            uniqueId: uniqueId,
            name: "social",
            tileImage:base_path+"img/social.png",
			size: "social-width tile-double tile-triple-vertical",
         	color: "bg-color-purple",
		//slidesFrom: [base_url+"social"]
        };
    },
	  newsrender: function (uniqueId) {
        return {
            uniqueId: uniqueId,
            name: "newsrender",
            size: 'tile',
            tileImage: base_path+'img/Rss.jpg',
            //slidesFrom: [base_url+"social"]
        };
    },
	  calender: function (uniqueId) {
        return {
            uniqueId: uniqueId,
            name: "calender",
           tileImage: base_path+"img/Calender.jpg",
            size: "tile",
            color: "bg-color-darken",
           
        };
    },
    mygaming: function (uniqueId) {
        return {
            uniqueId: uniqueId,
            name: "mygaming",
            color: "bg-color-blueDark",
			label:"<span class='count'>8</span>",
            size: "tile-double news-height desc-tile",
        };
    },
	mymusic: function (uniqueId) {
        return {
            uniqueId: uniqueId,
            name: "mymusic",
            color: "bg-color-blueDark",
			label:"<span class='count'>8</span>",
            size: "tile-double news-height desc-tile",
            appUrl: "http://oazabir.github.com/Droptiles/",
            slidesFrom: [base_url+"my-music1",
                base_url+"my-music2",
                base_url+"my-music3"],
            cssSrc: [base_path+"tiles/mymusic/mymusic.css"]
        };
    },
	myvideo: function (uniqueId) {
        return {
            uniqueId: uniqueId,
            name: "myvideo",
            color: "bg-color-pink",
			label:"<span class='count'>8</span>",
            size: "tile-quadro tile-double-vertical news-height desc-tile",
            appUrl: "http://oazabir.github.com/Droptiles/",
            slidesFrom: [base_url+"my-video1",
                base_url+"my-video2",
                base_url+"my-video3"],
            cssSrc: [base_path+"tiles/myvideo/myvideo.css"]
        };
    }


 };
