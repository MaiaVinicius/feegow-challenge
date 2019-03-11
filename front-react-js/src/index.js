import React from 'react';
import ReactDOM from 'react-dom';
import './index.css';
import * as serviceWorker from './serviceWorker';
import { Router, IndexRoute, Route, hashHistory } from 'react-router';
import home from './paginas/home'
import Lista from './paginas/lista'
import App from './App'


    ReactDOM.render( 
        <Router history={hashHistory}>
            <Route path="/" component={App}>
                <IndexRoute path="/" component={home} />
                <Route path="/Lista" component={Lista} />
            </Route>
        </Router>
        ,
        document.getElementById('root'));

// If you want your app to work offline and load faster, you can change
// unregister() to register() below. Note this comes with some pitfalls.
// Learn more about service workers: http://bit.ly/CRA-PWA

serviceWorker.unregister();