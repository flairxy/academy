import ApplicationRepository from './ApplicationRepository'

const repositories = {
    application: ApplicationRepository
}

export const RepositoryFactory = {
    get: name => repositories[name]
}
