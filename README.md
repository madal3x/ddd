# ddd
Hexagonal, DDD, RabbitMQ, command -> command handler, dependency injection, interface seggregation

Commands arrive in the application through adapters. These could translate an user interface action, a REST call or a message from the queue. In the example provided only the shop context has an user interface for the customer login. The reporting and the idaccess contexts receive input only on their message queues. 

The customer login user action is routed through the UIAdapter into the CustomerController which translates it to a LoginCustomerCommand for the shop context. Its handler, using a simulated synchronous request over the queue to the idaccess (authorization) context through the UserInRoleAdapter, sends a command to authorize the User into the Customer role by placing it on the idaccess' queue. The idaccess context gets the command on its queue and delegates to its AuthorizeUserCommand. If the authorization is succesful it returns an event containing an authorization token to its client.
 
From this moment the token will be used by the controllers to authorize the further user actions, and by the shop context to authenticate the commands that it receives. The authorization policy is a deny-default one, in the controllers through the requireAuthentication attribute of the Route which is by default true, and through the SecurityCommandHandler which filters out all not white-listed incoming requests, authorizing them.

The events published by the contexts are sent synchronous over the queue through the DomainEventPublisher which has wired an implementation of ExchangeTopicPublisher - one of the base extensible classes for communicating over the queues.

These are some of the things which were achieved, which are far less than the ones which were left out:
- using value objects for simple structures
- validating input data
- errors
- exceptions between contexts
- event receiving order
- receiving duplicated events
- command order
- command retry on fail
- entity modification concurrency
- event store and asynchronous dispatching on the queue
- queue authentication & authorization
- framework for keeping the deamons alive for listeners and workers, and tuning for performance (http://supervisord.org/)
