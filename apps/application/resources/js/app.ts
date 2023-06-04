import {
    ApiCtxSelect,
    AppLink,
    Button,
    CtxAddress,
    CtxCheckbox,
    CtxColor,
    CtxDropdown,
    CtxFileUpload,
    CtxForm,
    CtxInput,
    CtxPassword,
    CtxPhone,
    CtxTextarea,
    FormSection,
    Icon,
    InputErrorDisplay,
    PageTitle,
    Table,
} from '@/Components';
import BaseLayout from '@/Layouts/BaseLayout/index.vue';
import useGlobal from '@/utils/useGlobal';
import Date from '@/VuePlugins/Date';
import { App, plugin as inertiaPlugin } from '@inertiajs/inertia-vue3';
import { Loading, Notify, Quasar, useQuasar } from 'quasar';
import 'quasar/src/css/index.sass';
import { Component, createApp, h } from 'vue';
import '../sass/_quasar_variables.sass';
import { settings } from './utils/helpers/browser';

const el = document.getElementById('app')!;

const { reset } = useGlobal();

createApp({
    render: () =>
        h(App, {
            initialPage: JSON.parse(el.dataset.page!),
            resolveComponent: async (name: string) => {
                reset();
                const quasar = useQuasar();

                if (quasar?.dark) {
                    quasar.dark.set(settings('dark-mode') || false);
                }

                const page = (await require(`./Pages/${name}/index.vue`))
                    .default;

                if (!page?.layout) {
                    switch (true) {
                        case name.startsWith('CentralDomain'):
                            page.layout =
                                await require('@/Layouts/CentralDomain/Blank')
                                    .default;
                            break;

                        default:
                            page.layout = await require('@/Layouts/Default')
                                .default;
                    }
                }

                return page;
            },
        }),
})
    .component('CtxFileUpload', CtxFileUpload as unknown as Component)
    .component('EdButton', Button as unknown as Component)
    .component('Button', Button as unknown as Component)
    .component('AppLink', AppLink as unknown as Component)
    .component('CtxForm', CtxForm as unknown as Component)
    .component('CtxPassword', CtxPassword as unknown as Component)
    .component('CtxColor', CtxColor as unknown as Component)
    .component('Icon', Icon as unknown as Component)
    .component('CtxInput', CtxInput as unknown as Component)
    .component('CtxCheckbox', CtxCheckbox as unknown as Component)
    .component('CtxTextarea', CtxTextarea as unknown as Component)
    .component('ApiCtxSelect', ApiCtxSelect as unknown as Component)
    .component('CtxDropdown', CtxDropdown as unknown as Component)
    .component('PageTitle', PageTitle as unknown as Component)
    .component('InputErrorDisplay', InputErrorDisplay as unknown as Component)
    .component('CtxPhone', CtxPhone as unknown as Component)
    .component('BaseLayout', BaseLayout as unknown as Component)
    .component('CtxAddress', CtxAddress as unknown as Component)
    .component('FormSection', FormSection as unknown as Component)
    .component('DSTable', Table as unknown as Component)
    .use(inertiaPlugin)
    .use(Date)
    .use(Quasar, {
        plugins: {
            Loading,
            Notify,
        }, // import Quasar plugins and add here
        config: {
            brand: {
                primary: '#1976d2',
                secondary: '#26A69A',
                accent: '#9C27B0',

                dark: '#0f0f0f',
                'dark-page': '#050404',

                positive: '#21BA45',
                negative: '#C10015',
                info: '#31CCEC',
                warning: '#F2C037',
            },
        },
    })
    .mount(el);
