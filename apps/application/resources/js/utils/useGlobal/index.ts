import { Breadcrumb } from '@/utils/types/navs';
import { QNotifyCreateOptions, useQuasar } from 'quasar';
import { computed, reactive } from 'vue';

interface ReactiveStateType {
    title?: string;
    breadcrumbs?: Breadcrumb[];
}

const state = reactive<ReactiveStateType>({
    title: undefined,
    breadcrumbs: undefined,
});

interface ShowNotificationActionType {
    label: string;
    handler: (params: any) => any;
}

interface ShowNotificationType extends QNotifyCreateOptions {
    color?: string;
    textColor?: string;
    icon?: string;
    message?: string;
    avatar?: string;
    multiLine?: boolean;
    timeout?: number;
}

interface StandardNotificationType {
    type: 'save-success' | 'form-fail' | 'save-fail';
    message?: string;
}

export default function useGlobal() {
    const quasar = useQuasar();

    const setTitle = (title: string): void => {
        state.title = title;
    };

    const clearTitle = (): void => {
        state.title = undefined;
    };

    const setBreadcrumbs = (segments: Breadcrumb[]): void => {
        if (!state.breadcrumbs) {
            state.breadcrumbs = [];
        }

        state.breadcrumbs = segments;
    };

    const clearBreadcrumbs = (): void => {
        state.breadcrumbs = undefined;
    };

    const addBreadcrumb = (segment: Breadcrumb): void => {
        if (!state.breadcrumbs) {
            state.breadcrumbs = [];
        }

        state.breadcrumbs.push(segment);
    };

    const reset = (): void => {
        clearTitle();
        clearBreadcrumbs();
    };

    const showNotification = ({
        color,
        textColor,
        icon,
        message,
        position = 'bottom-right',
        avatar,
        multiLine,
        actions,
        timeout = 5000,
    }: ShowNotificationType): void => {
        quasar.notify({
            color,
            textColor,
            icon,
            message,
            position,
            avatar,
            multiLine,
            actions,
            timeout,
        });
    };

    const standardNotification = ({
        type,
        message = undefined,
    }: StandardNotificationType) => {
        switch (type) {
            case 'save-success':
                return showNotification({
                    color: 'success',
                    message: message || 'Saved',
                });
            case 'form-fail':
                return showNotification({
                    color: 'negative',
                    message: message || 'Saved',
                });
            case 'save-fail':
                return showNotification({
                    color: 'negative',
                    message: message || 'Please check your form and try again.',
                });
        }
    };

    return {
        title: computed(() => {
            return state.title;
        }),

        breadcrumbs: computed(() => {
            return state.breadcrumbs;
        }),

        setTitle,
        clearTitle,

        setBreadcrumbs,
        clearBreadcrumbs,
        addBreadcrumb,

        reset,

        showNotification,
        standardNotification,
    };
}
