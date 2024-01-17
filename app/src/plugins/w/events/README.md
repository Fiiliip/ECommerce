# W / Events
- This plugin will add mitt global events to your app
- https://www.npmjs.com/package/mitt
# Required third-party plugins
`$ npm i mitt@2`

# Import in `main.ts`
```javascript
import events from '@/plugins/w/events'

const app = createApp(App)
    .use(events)
```
# Examples
1. Listen for event
```javascript
this.eventBus.on('eventname', (optionalData) => ...do something)
```

2. Listen for all events
```javascript
this.eventBus.on('*', (optionalData) => ...do something)
```

3. Fire event
```javascript
this.eventBus.emit('eventname', optionalData)
```

4. Clear all event listeners
```javascript
this.eventBus.all.clear()
```

5. More on https://www.npmjs.com/package/mitt