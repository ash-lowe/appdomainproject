var UserAccount = require('./useraccount');
const dboperations = require('./dboperations');


var express = require('express');
var bodyParser = require('body-parser')
var cors = require('cors');
var app = express();
var router = exress.Router();

app.use(bodyParser.urlencoded({extended: true}));
app.use(bodyParser.json());
app.use(cors());
app.use('/api',router);

router.use((request,response,next)=>{
    console.log('middleware');
    next();
})

router.route('/useraccount').get((request,response)=>{
    dboperations.getUsers().then(result =>{
        response.json(result[0])
    })
})

var port = process.env.PORT || 5140;
app.listen(port);
console.log('Order API is running at' + port);

dboperations.getUsers().then(result =>{
    console.log(result);
})