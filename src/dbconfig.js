const sql = require("mysql");
require("msnodesqlv8");
const conn = new sql.Connection({
    driver: 'msnodesqlv8',
    server: 'LAPTOP-OJU1IBVT\SQLEXPRESS',
    database: 'APPDOMAINPROJECT',
    options: {
        trustedConnection: true,
        enableArithAort: true,
        instancename: 'SQLEXPRESS', 
      },
});

  