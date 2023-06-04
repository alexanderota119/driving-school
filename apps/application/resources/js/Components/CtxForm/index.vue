<template>
    <q-overlay v-model="loading" :no-scroll="true">
        <form-wrapper ref="formWrapper" :form="form">
            <q-form method="post" @submit.prevent="onSubmit">
                <slot />

                <ed-button
                    v-if="addSubmitButton"
                    :loading="loading"
                    type="submit"
                    variant="primary"
                >
                    Submit
                </ed-button>

                <ed-button
                    v-if="addSubmitButton"
                    class="q-ml-sm"
                    type="button"
                    variant="negative"
                    @click="handleBack"
                >
                    Cancel
                </ed-button>

                <ed-button
                    v-if="false"
                    class="q-ml-sm"
                    type="button"
                    variant="negative"
                    @click="resetForm"
                >
                    Reset Form
                </ed-button>
            </q-form>
        </form-wrapper>
    </q-overlay>
</template>
<script lang="ts" setup>
import FormWrapper from '@/Components/CtxForm/FormWrapper.vue';
import { formResetState } from '@/utils';
import {
    EdDrivingComputedRef,
    GenericFormSubmitType,
} from '@/utils/types/form';
import { Breadcrumb } from '@/utils/types/navs';
import useApiCalls, { POST, PUT } from '@/utils/useApiCalls';
import useGlobal from '@/utils/useGlobal';
import { Inertia } from '@inertiajs/inertia';
import { get } from 'lodash';
import { useQuasar } from 'quasar';
import { computed, inject, onMounted, reactive, ref, watch } from 'vue';

const quasar = useQuasar();

const formWrapper = ref(null) as any;

type FormMethods = 'put' | 'post' | 'get';

const resetForm = inject<EdDrivingComputedRef<any>>(
    formResetState,
    'no luck',
) as EdDrivingComputedRef;
console.log('resetForm.init', {
    resetForm,
});

watch(resetForm, vvv => {
    console.log('resetForm.changed', {
        resetForm,
        vvv,
    });
});

interface Props {
    form: {
        [key: string]: string | string[] | any;
    };
    addSubmitButton?: boolean;
    action?: string;
    method?: FormMethods;
    debug?: boolean;
    hasFile?: boolean;
    noTitle?: boolean;
    title?: string;
    breadcrumbHref?: string;
    breadcrumb: Breadcrumb[];
    inertiaSubmit: boolean;
}

const {
    setTitle,
    addBreadcrumb,
    standardNotification: standardNotification,
} = useGlobal();

const props = withDefaults(defineProps<Props>(), {
    method: 'post',
    noTitle: false,
    inertiaSubmit: true,
});

watch(props.form, newFormValues => {
    formWrapper.value.setForm(newFormValues);
});

const loading = ref<boolean>(false);

const submitUrl = computed<string>(() => {
    return props.action || '';
});

onMounted(() => {
    // TODO :: add set form errors functionality
    // setFormErrors();

    formWrapper.value.setForm(props.form);

    if (props.title) {
        addBreadcrumb({ title: props.title, href: props.breadcrumbHref });

        props.breadcrumb && props.breadcrumb.forEach(addBreadcrumb);
    }

    if (!props.noTitle) {
        const actionTitle = props.method === 'put' ? 'Update' : 'Save';

        if (props.title) {
            setTitle(`${actionTitle} ${props.title} Form`);
        } else {
            setTitle(`${actionTitle} Form`);
        }
    }
});

/**
 * if the action and method are set then try to submit the form
 * @param formData
 */
const handleSubmit = (formData: GenericFormSubmitType) => {
    const theUrl = submitUrl.value as string;

    if (!submitUrl || !props.method) {
        return false;
    }

    // TODO :: if form has file create new FormDAtga object and send that to the api
    // if()

    return handleApiCall(formData, theUrl, props.method);
};

const emit = defineEmits(['submit']);
const data = reactive({ submitted: false });

const handleApiCall = async (
    formData: GenericFormSubmitType | FormData,
    theUrl: string,
    method: FormMethods,
) => {
    if (props.inertiaSubmit) {
        let method = props.method;
        const additionalOptions = {};

        // TODO :: FIXME :: need to be dynamic
        // noinspection EqualityComparisonWithCoercionJS
        if (props.method == PUT /* formWrapper.value.hasFile*/) {
            method = POST;
            additionalOptions['_method'] = PUT;
        }
        // console.log('inertiaSubmit', {
        //     formData,
        //     method,
        //     additionalOptions,
        //     hasFile: formWrapper.value.hasFile,
        // });

        Inertia[method](theUrl, { ...formData, ...additionalOptions } as any, {
            forceFormData: formWrapper.value.hasFile,

            onError: (errors = {}) => {
                // TODO :: add set form errors functionality
                // setFormErrors(errors as unknown as FormErrorType);
                formWrapper.value.validate(errors as unknown);

                standardNotification({
                    type: 'save-fail',
                });

                loading.value = false;
                quasar.loading.hide();
            },
            onSuccess: () => {
                loading.value = false;
                quasar.loading.hide();

                quasar.notify({
                    message: 'Saved',
                    position: 'top',
                });
            },
        });
    } else {
        try {
            console.log('useApiCalls.submit');
            const response = await useApiCalls(theUrl, {
                method,
                params: formData,
            });

            standardNotification({
                type: 'save-success',
            });

            return response;
        } catch (e) {
            const errors = get(e, 'response.data.errors', {});

            console.log('handleApiCall.failed', {
                e,
                errors,
            });

            standardNotification({
                type: 'save-fail',
            });

            // TODO :: add set form errors functionality
            // setFormErrors(errors);
        } finally {
            loading.value = false;
            quasar.loading.hide();
        }
    }
};

const onSubmit = () => {
    quasar.loading.show({
        message: 'Some important process  is in progress. Hang on...',
    });

    data.submitted = true;

    // TODO :: validate
    formWrapper.value.validate();
    // TODO :: isValid continue to callback
    // TODO :: if not callback do default, call the api
    emit('submit', formWrapper.value.form);
    handleSubmit(formWrapper.value.form);
};

const handleBack = () => {
    if (confirm('Sure?')) {
        window.history.back();
    }
};
</script>
