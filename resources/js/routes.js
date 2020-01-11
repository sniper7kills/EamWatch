import VueRouter from 'vue-router';


let routes = [
    {
        path: '/',
        name: 'message-listing',
        component: () => import(/* webpackChunkName: "messages/listing" */ './components/messages/listing')
    },
    {
        path: '/skyking',
        name: 'skyking-listing',
        component: () => import(/* webpackChunkName: "messages/listing" */ './components/messages/skyking')
    },
    {
        path: '/view/:message_id',
        name: 'message-view',
        component: () => import(/* webpackChunkName: "messages/view" */ './components/messages/view')
    },
    {
        path: '/add',
        name: 'message-add',
        component: () => import(/* webpackChunkName: "messages/add" */ './components/messages/add')
    },
];


export default new VueRouter({
    mode: 'history',
    routes,
    linkExactActiveClass: 'active'
});
