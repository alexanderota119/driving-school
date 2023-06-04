import axios from 'axios';

export const POST = 'post';
export const GET = 'get';
export const PUT = 'put';
export const DELETE = 'delete';

type UseApiCallsOptionsType = {
    method: typeof POST | typeof GET | typeof PUT | typeof DELETE;
    params?: { [key: string]: any }[] | any;
};
type UseApiCallsType = (
    url: string,
    options?: UseApiCallsOptionsType,
) => Promise<any>;

const useApiCalls: UseApiCallsType = (url, options = { method: GET }) => {
    switch (options.method) {
        case POST:
            return axios.post(url, options.params).then(({ data }) => data);
        case PUT:
            return axios.put(url, options.params).then(({ data }) => data);
        case GET:
        default:
            return axios.get(url).then(({ data }) => data);
    }
};

export default useApiCalls;
