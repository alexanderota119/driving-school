import * as Inertia from '@inertiajs/inertia';
import { RequestPayload } from '@inertiajs/inertia';
import { InertiaFormProps } from '@inertiajs/inertia-vue3';

export type InputTypeTypes =
    | 'text'
    | 'password'
    | 'textarea'
    | 'email'
    | 'search'
    | 'tel'
    | 'file'
    | 'number'
    | 'url'
    | 'time'
    | 'date';

interface additionalComputedValue {
    value: any;
}

export type EdDrivingComputedRef<T = string | number> = any;

interface RequestMethods<T> {
    data(): T;

    transform(callback: (data: T) => object): this;

    defaults(): this;

    defaults(field: keyof T, value: string): this;

    defaults(fields: Record<keyof T, string>): this;

    reset(...fields: (keyof T)[]): this;

    clearErrors(...fields: (keyof T)[]): this;

    setError(field: keyof T, value: string): this;

    setError(errors: Record<keyof T, string>): this;

    submit(
        method: string,
        url: string,
        options?: Partial<Inertia.VisitOptions>,
    ): void;

    get(url: string, options?: Partial<Inertia.VisitOptions>): void;

    post(url: string, options?: Partial<Inertia.VisitOptions>): void;

    put(url: string, options?: Partial<Inertia.VisitOptions>): void;

    patch(url: string, options?: Partial<Inertia.VisitOptions>): void;

    delete(url: string, options?: Partial<Inertia.VisitOptions>): void;

    cancel(): void;

    // [key: string]: keyof InertiaFormProps<T>;
}

interface FormState<T> {
    isDirty: boolean;
    errors: Record<keyof T, string>;
    hasErrors: boolean;
    processing: boolean;
    progress: Inertia.Progress | null;
    wasSuccessful: boolean;
    recentlySuccessful: boolean;
}

type FormExtendsTypes<T> = InertiaFormProps<T> &
    RequestPayload &
    RequestMethods<T> &
    FormState<T>;

export type FormSubmitType<T> = FormExtendsTypes<T>;
export type GenericFormSubmitType = FormExtendsTypes<any>;
