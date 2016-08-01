class Stream {

	constructor() {

		this.everyMinut = 60000;
		this.everySecond = 1000;

		this.battery = 100;
		this.batteryLimit = 30;
	}

	getCurrentBattery() {

		window.navigator.getBattery().then((battery) => {

			this.battery = battery.level * 100;

			if(this.battery < this.batteryLimit) {
				commandsFunctions.makeMiaSpeak(this.battery);
			}

			setTimeout(() => {
				this.getCurrentBattery();
			}, this.everyMinut);
		});
	}
}

const streams = new Stream();

// streams.getCurrentBattery();
