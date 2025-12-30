import './page/rootrifs-alert-list';
import './page/rootrifs-alert-detail';
import deDE from './snippet/de-DE.json';
import enGB from './snippet/en-GB.json';

Shopware.Module.register('rootrifs-alert', {
    type: 'plugin',
    name: 'rootrifs-alert',
    title: 'rootrifs-alert.general.mainMenuItemGeneral',
    description: 'rootrifs-alert.general.descriptionTextModule',
    color: '#ff3d58',
    icon: 'regular-bell',

    snippets: {
        'de-DE': deDE,
        'en-GB': enGB
    },

    navigation: [{
        label: 'rootrifs-alert.general.mainMenuItemGeneral',
        path: 'rootrifs.alert.list',
        parent: 'sw-content',
        position: 100
    }],

    routes: {
        list: {
            component: 'rootrifs-alert-list',
            path: 'list'
        },
        detail: {
            component: 'rootrifs-alert-detail',
            path: 'detail/:id',
            meta: {
                parentPath: 'rootrifs.alert.list'
            }
        },
        create: {
            component: 'rootrifs-alert-detail',
            path: 'create',
            meta: {
                parentPath: 'rootrifs.alert.list'
            }
        }
    }
});