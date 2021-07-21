/**
* Method called for generate a random string for the length passed in parameter
* @param lgth
*/
function generateRandomString(lgth) {
	const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    const charactersLength = characters.length;
    let result = '';
    for (let i = 0; i < lgth; i++) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    return result;
}