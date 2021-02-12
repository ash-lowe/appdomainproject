var UserAccount = require('./useraccount');
const dboperations = require('./dboperations');

dboperations.getUsers().then(result =>{
    console.log(result);
})