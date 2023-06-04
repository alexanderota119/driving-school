import { Inertia } from '@inertiajs/inertia';

type RequestMethodType = (
    url: string,
    method?: 'get' | 'post' | 'put',
) => Promise<any>;

export const ApiCAll: RequestMethodType = (url, method = 'get', ...others) => {
    return new Promise((onSuccess, onError) => {
        Inertia.visit(url, {
            method: method as any,
            onSuccess,
            onError,
            ...others,
        });
    });
};

export default ApiCAll;
