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
        path: '/edit/:message_id',
        name: 'message-edit',
        component: () => import(/* webpackChunkName: "messages/edit" */ './components/messages/edit')
    },
    {
        path: '/delete/:message_id',
        name: 'message-delete',
        component: () => import(/* webpackChunkName: "messages/delete" */ './components/messages/delete')
    },
    {
        path: '/add',
        name: 'message-add',
        component: () => import(/* webpackChunkName: "messages/add" */ './components/messages/add')
    },
    {
        path: '/recording/:recording_id',
        name: 'recording-view',
        component: () => import(/* webpackChunkName: "recordings/view" */ './components/recording/view')
    },
    {
        path: '/automated-recordings',
        name: 'automated-listing',
        component: () => import(/* webpackChunkName: "automated/list" */ './components/automated/list')
    },
    {
        path: '/guest/:guest_id',
        name: 'guest-view',
        component: () => import(/* webpackChunkName: "guest/view" */ './components/guest/view')
    },
    {
        path: '/user/:user_id',
        name: 'user-view',
        component: () => import(/* webpackChunkName: "guest/view" */ './components/user/view')
    },
];


export default new VueRouter({
    mode: 'history',
    routes,
    linkExactActiveClass: 'active'
});
