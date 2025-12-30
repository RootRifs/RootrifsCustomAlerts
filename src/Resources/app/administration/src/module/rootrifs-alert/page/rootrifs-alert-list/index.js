import template from './rootrifs-alert-list.html.twig';

const { Component, Mixin } = Shopware;
const { Criteria } = Shopware.Data;

Component.register('rootrifs-alert-list', {
    template,

    inject: ['repositoryFactory'],

    mixins: [
        Mixin.getByName('listing')
    ],

    data() {
        return {
            alerts: null,
            isLoading: true
        };
    },

    computed: {
        repository() {
            return this.repositoryFactory.create('rootrifs_custom_alert');
        },

        columns() {
            return [{
                property: 'internalTitle',
                label: this.$t('rootrifs-alert.list.columnTitle'),
                routerLink: 'rootrifs.alert.detail',
                inlineEdit: 'string',
                allowResize: true,
                primary: true
            }, {
                property: 'active',
                label: this.$t('rootrifs-alert.list.columnActive'),
                inlineEdit: 'boolean',
                allowResize: true
            }, {
                property: 'position',
                label: this.$t('rootrifs-alert.list.columnPosition'),
                allowResize: true
            }, {
                property: 'style',
                label: this.$t('rootrifs-alert.list.columnStyle'),
                allowResize: true
            }];
        }
    },

    methods: {
        getList() {
            this.isLoading = true;
            const criteria = new Criteria();

            criteria.addAssociation('salesChannel');

            return this.repository.search(criteria, Shopware.Context.api).then((result) => {
                this.alerts = result;
                this.isLoading = false;
            });
        }
    }
});