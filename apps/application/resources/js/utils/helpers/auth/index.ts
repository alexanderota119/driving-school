import {
    InstructorModel,
    StudentModel,
    UserModel,
} from '@/utils/types/extended-models';
import * as Inertia from '@inertiajs/inertia';
import { usePage } from '@inertiajs/inertia-vue3';
import { get } from 'lodash';
import { ComputedRef } from 'vue';

export interface UsePagePropsType<PageProps = any> {
    props: ComputedRef<PageProps & Inertia.PageProps>;
    url: ComputedRef<string>;
    component: ComputedRef<string>;
    version: ComputedRef<string | null>;
    value: keyof PageProps;
}

const pageProps = <T = any>(): UsePagePropsType<T> => {
    return usePage().props as unknown as UsePagePropsType<T>;
};

const auth = <T = UserModel & InstructorModel & StudentModel>(
    property: string | undefined = undefined,
    defaultValue: any = undefined,
): T => {
    const user =
        (
            pageProps<T>().value as unknown as UserModel &
                InstructorModel &
                StudentModel
        ).auth || {};

    if (!user) {
        return defaultValue;
    }

    console.log({ user });

    const found = pageProps<T>();

    console.log({ found });

    if (property) {
        // @ts-ignore
        return get(user.user, property, defaultValue) as T;
    }

    return user as T;
};

export default auth;
