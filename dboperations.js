var config = require('./dbconfig');
var sql = require("mysql"); 
async function getUsers(){
    try{
        let pool = await sql.connect(config);
        let APPDOMAINPROJECT = await pool.request().query("SELECT * from useracount");
        return APPDOMAINPROJECT.recordsets; 
    }
    catch(error){
        console.log(error);
    }
}

module.exports ={ 
    getUsers : getUsers
}