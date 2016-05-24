var config = {
	apiKey: "AIzaSyA3nS8Q8atlexEqRuMd_CWB7vauqY-3ROI",
	authDomain: "mia-robot.firebaseapp.com",
	databaseURL: "https://mia-robot.firebaseio.com",
	storageBucket: "mia-robot.appspot.com",
};

firebase.initializeApp(config);

const database = firebase.database();

function registerCommands() {

	for(let command in entries) {

		database.ref('commands/' + entries[command]).set({
			text: command
		});
	}

	for(let command in privateEntries) {

		database.ref('privateCommands/' + privateEntries[command]).set({
			text: command
		});
	}
}

// registerCommands();

function remindMe(date, command, preRemindTime) {

	database.ref('remind/' + formatedDate).set({
		command: command,
		reminded: false,
		preReminded: false,
		preRemindTime: preRemindTime
	});
}

const date = new Date(),
	formatedDate = date.getFullYear() + '-' + date.getMonth() + '-' + date.getDay() + ' ' + date.getHours() + ':' + date.getMinutes()
;

// remindMe(formatedDate, "Rappelle moi de prendre le petit déj", 5);
