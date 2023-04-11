# Shiftbase/Egress

An egress design project for the purpose of application on Shiftbase


## Namespace

```
# App: External SMS service provider
# Activities:
#     - Check Balance #not implemented
#     - Send SMS #not implemented
#     - Get SMS details 
#     - list SMS details
App:
    Contract:
        - Activity
        - Result
        - Paginated
    Factory:
        - RequestFactory
        - ResponseFactory
        - ClientFactory
        - ExternalRequestFactory
        - ActivityFactory
    Models:
        - Request
        - Response
        - ExternalRequest
        - ExternalResponse
        - Activities:
            - Balance
            - Send
            - SmsDetails
            - SmsList
        - Results:
            - Balance
            - Send
            - Sms
            - SmsList
    Middlewares:
        - MiddlewareProvider
        - HeaderModification
        - QueryModification

    Controller
    middleware.yaml
```


## Acknowledgements

- [Youtube on Egress](https://www.youtube.com/watch?v=AfkRWUJKiDo)
- [Crash course on plantUml](https://plantuml.com/)
 