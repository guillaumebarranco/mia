class Calcul {

	searchCalcul(entry, fromTemplate = false) {

		let foundMatch = false;

		// Soustraction
		if( /^[0-9]*-[0-9]*$/ .test(entry)) {

			const nbs = entry.split("-");
			const result = parseInt(nbs[0]) - parseInt(nbs[1]);

			commandsFunctions.getMiaAnswer(result, 'write', false);
			foundMatch = true;
		}

		// Addition
		if( /^[0-9]*\+[0-9]*$/ .test(entry)) {

			const nbs = entry.split("+");
			const result = parseInt(nbs[0]) + parseInt(nbs[1]);

			commandsFunctions.getMiaAnswer(result, 'write', false);
			foundMatch = true;
		}

		// Multiplication
		if( /^[0-9]*\*[0-9]*$/ .test(entry)) {

			const nbs = entry.split("*");
			const result = parseInt(nbs[0]) * parseInt(nbs[1]);

			commandsFunctions.getMiaAnswer(result, 'write', false);
			foundMatch = true;
		}

		// Division
		if( /^[0-9]*\/[0-9]*$/ .test(entry)) {

			const nbs = entry.split("/");
			const result = parseInt(nbs[0]) / parseInt(nbs[1]);

			commandsFunctions.getMiaAnswer(result, 'write', false);
			foundMatch = true;
		}

		if(fromTemplate) {
			return result;
		}

		return !foundMatch;
	}
}
