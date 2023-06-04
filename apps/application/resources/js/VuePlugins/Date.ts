import {
    userDate,
    userDatetime,
    userHumanReadable,
    userTime,
} from '@/utils/helpers/date';

export default {
    install(Vue, options) {
        Vue.mixin({
            methods: {
                userDate,
                userTime,
                userDatetime,
                userHumanReadable,
            },
        });
    },
};
