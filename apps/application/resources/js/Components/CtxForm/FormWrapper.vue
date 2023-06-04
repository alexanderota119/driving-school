<template>
    <slot />
</template>
<script lang="ts" setup>
import {
    formResetState,
    formSetState,
    formStateRead,
    formStateUpdate,
    formStateUpdateCheckbox,
    formStateValidate,
    getError,
    onChange,
    onChangeDate,
    trackHasFile,
} from '@/utils';
import { UserDateTime } from '@/utils/types/date';
import { get, set } from 'lodash';
import { computed, provide, ref, toRefs } from 'vue';

interface Props {
    form: any;
}

const isValid = ref<boolean>(true);

const props = withDefaults(defineProps<Props>(), {
    form: {},
});

const form = ref({});
const dateFields = ref({});
const errors = ref({});
const hasFile = ref(false);

// Using `toRefs()` makes it possible to use
// spreading in the consuming component.
// Making the return value `readonly()` prevents
// users from mutating global state.
provide(formStateRead, toRefs({ form, errors, hasFile }));

const setForm = (value: any, hasFileParam: boolean | undefined = undefined) => {
    console.log('setForm', {
        value,
    });

    form.value = { ...value };

    if (hasFileParam) {
        hasFile.value = hasFileParam;
    }
};
provide(formSetState, setForm);
provide('formStateSetter', setForm);

const formReset = (
    value: any = {},
    hasFileParam: boolean | undefined = undefined,
) => {
    console.log('formReset', {
        value,
    });

    form.value = { ...value };

    if (hasFileParam) {
        hasFile.value = hasFileParam;
    }
};
provide(formResetState, formReset);

const handleHasFile = (hasFileParam: boolean = false) => {
    hasFile.value = hasFileParam;
};
provide(trackHasFile, handleHasFile);

const update = (
    property: any,
    defaultValue: any = '',
    { file = false } = {},
) => {
    return computed({
        get() {
            return get(form.value, `${property}`) || defaultValue;
        },
        set(newValue) {
            if (file) {
                handleHasFile(true);
            }

            console.log('update.pre', {
                property,
                setting: `form.value.${property}`,
                form: { ...form },
                errors: { ...errors },
            });

            set(form.value, property, newValue || '');
            set(errors.value, property, newValue || '');
        },
    });
};
provide(formStateUpdate, update);
provide(onChange, update);

const dateUpdate = (
    property: any,
    accessor = 'datetime',
    defaultValue: any = '',
) => {
    return computed({
        get() {
            dateFields.value = {
                ...dateFields,
                [property]: true,
            };

            const date = get<any, string>(
                form.value,
                `${property}`,
            ) as UserDateTime;

            const { [accessor]: value, [`${accessor}-new`]: newValue } =
                (date || {}) as any;

            try {
                return newValue || value || defaultValue;
            } catch (e) {
                return defaultValue;
            }
        },
        set(newValue) {
            if (!newValue) {
                set(form.value, `${property}.${accessor}`, newValue || '');
            }

            set(form.value, `${property}.${accessor}`, newValue);
            set(form.value, `${property}.is_dirty`, true);
            set(errors.value, `${property}`, undefined);
        },
    });
};
provide(onChangeDate, dateUpdate);

const handleFormStateUpdateCheckbox = (
    property: string,
    defaultValue: any = false,
) => {
    return computed({
        get() {
            return get(form, property, defaultValue);
        },
        set(newValue: boolean) {
            console.log('handleFormStateUpdateCheckbox.pre', {
                property,
                setting: `form.value.${property}`,
                form: { ...form },
                errors: { ...errors },
            });
            set(form.value, property, newValue === true);
            set(errors.value, property, undefined);
        },
    });
};
provide(formStateUpdateCheckbox, handleFormStateUpdateCheckbox);

const validate = (errorsParams = {}): boolean => {
    try {
        const passedValidation = Object.keys(errorsParams).length > 0;
        errors.value = { ...errorsParams };
        isValid.value = passedValidation;
        return passedValidation;
    } catch (e) {
        return true;
    }
};
provide(formStateValidate, update);

const handleGetError = (fieldName: string): any => {
    return computed(() => {
        const errs = get(errors, fieldName);

        if (!errs) {
            return undefined;
        }

        if (!Array.isArray(errs)) {
            return [errs];
        }

        return errs;
    });
};

provide(getError, handleGetError);

defineExpose({
    isValid,
    validate,
    form: form || {},
    errors: errors || {},
    hasFile: hasFile || false,
    setForm,
});
</script>
