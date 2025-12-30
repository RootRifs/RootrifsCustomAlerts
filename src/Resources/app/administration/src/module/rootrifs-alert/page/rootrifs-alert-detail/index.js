import template from './rootrifs-alert-detail.html.twig';

const { Component, Mixin } = Shopware;

Component.register('rootrifs-alert-detail', {
    template,

    inject: ['repositoryFactory'],

    mixins: [
        Mixin.getByName('notification'),
        Mixin.getByName('placeholder')
    ],


    data() {
        return {
            alert: null,
            isLoading: false,
            processSuccess: false
        };
    },

    computed: {
        repository() {
            return this.repositoryFactory.create('rootrifs_custom_alert');
        },

        styleOptions() {
            return [
                { value: 'info', label: this.$t('rootrifs-alert.options.style.info') },
                { value: 'success', label: this.$t('rootrifs-alert.options.style.success') },
                { value: 'warning', label: this.$t('rootrifs-alert.options.style.warning') },
                { value: 'danger', label: this.$t('rootrifs-alert.options.style.danger') }
            ];
        },

        positionOptions() {
            return [
                { value: 'minicart', label: this.$t('rootrifs-alert.options.position.minicart') },
                { value: 'cart', label: this.$t('rootrifs-alert.options.position.cart') },
                { value: 'checkout', label: this.$t('rootrifs-alert.options.position.checkout') },
                { value: 'account', label: this.$t('rootrifs-alert.options.position.account') },
                { value: 'productdetail', label: this.$t('rootrifs-alert.options.position.productdetail') }
            ];
        }
    },

    created() {
        this.getAlert();
    },

    methods: {
        getAlert() {
            this.isLoading = true;
            if (this.$route.params.id) {
                this.repository.get(this.$route.params.id, Shopware.Context.api).then((entity) => {
                    entity.active = !!entity.active;
                    this.alert = entity;
                    this.isLoading = false;
                });
            } else {
                this.alert = this.repository.create(Shopware.Context.api);
                this.alert.internalTitle = '';
                this.alert.heading = '';
                this.alert.salesChannelId = null;
                this.alert.ruleId = null;
                this.alert.active = false;
                this.alert.style = 'info';
                this.alert.position = 'checkout';
                this.alert.message = '';
                this.isLoading = false;
            }
        },

        onChangeLanguage() {
            this.getAlert();
        },

        onSave() {
            this.isLoading = true;
            console.log('Speichere Alert Nachricht:', this.alert.message);

            this.repository.save(this.alert, Shopware.Context.api).then(() => {
                this.isLoading = false;
                this.processSuccess = true;
            }).catch((exception) => {
                this.isLoading = false;
                this.createNotificationError({
                    title: 'Fehler',
                    message: exception.message
                });
            });
        },

        onProcessFinish() {
            this.processSuccess = false;
            this.$router.push({ name: 'rootrifs.alert.list' });
        }
    }
});