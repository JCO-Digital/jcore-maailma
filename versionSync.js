const { readFileSync, writeFileSync } = require("fs");

exports.preCommit = (props) => {
	fileReplace(
		"jcore-maailma.php",
		/(.*)Version:( *)[\.0-9]*$/m,
		`$1Version:$2${props.version}`,
	);
	fileReplace(
		"jcore-maailma.php",
		/define\( 'JCORE_MAAILMA_VERSION', '[0-9.]+' \);/m,
		`define\( 'JCORE_MAAILMA_VERSION', '${props.version}' \);`,
	);
};

const fileReplace = (filename, search, replace) => {
	try {
		const file = readFileSync(filename);
		const updatedFile = file.toString().replace(search, replace);
		writeFileSync(filename, updatedFile);
	} catch (error) {
		console.error(error);
	}
};
