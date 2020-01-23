import VueRouter from 'vue-router';


let routes = [
    {
        path: '/',
        name: 'message-listing',
        component: () => import(/* webpackChunkName: "js/chunks/messages/listing" */ './components/messages/listing')
    },
    {
        path: '/skyking',
        name: 'skyking-listing',
        component: () => import(/* webpackChunkName: "js/chunks/messages/skyking" */ './components/messages/skyking')
    },
    {
        path: '/view/:message_id',
        name: 'message-view',
        component: () => import(/* webpackChunkName: "js/chunks/messages/view" */ './components/messages/view')
    },
    {
        path: '/edit/:message_id',
        name: 'message-edit',
        component: () => import(/* webpackChunkName: "js/chunks/messages/edit" */ './components/messages/edit')
    },
    {
        path: '/delete/:message_id',
        name: 'message-delete',
        component: () => import(/* webpackChunkName: "js/chunks/messages/delete" */ './components/messages/delete')
    },
    {
        path: '/add',
        name: 'message-add',
        component: () => import(/* webpackChunkName: "js/chunks/messages/add" */ './components/messages/add')
    },
    {
        path: '/delete/:message_id/:comment_id',
        name: 'comment-delete',
        component: () => import(/* webpackChunkName: "js/chunks/comment/delete" */ './components/comment/delete')
    },
    {
        path: '/edit/:message_id/:comment_id',
        name: 'comment-edit',
        component: () => import(/* webpackChunkName: "js/chunks/comment/edit" */ './components/comment/edit')
    },
    {
        path: '/recording/:recording_id',
        name: 'recording-view',
        component: () => import(/* webpackChunkName: "js/chunks/recordings/view" */ './components/recording/view')
    },
    {
        path: '/automated-recordings',
        name: 'automated-listing',
        component: () => import(/* webpackChunkName: "js/chunks/automated/list" */ './components/automated/list')
    },
    {
        path: '/guest/:guest_id',
        name: 'guest-view',
        component: () => import(/* webpackChunkName: "js/chunks/guest/view" */ './components/guest/view')
    },
    {
        path: '/user/:user_id',
        name: 'user-view',
        component: () => import(/* webpackChunkName: "js/chunks/user/view" */ './components/user/view')
    },
];


export default new VueRouter({
    mode: 'history',
    routes,
    linkExactActiveClass: 'active'
});
