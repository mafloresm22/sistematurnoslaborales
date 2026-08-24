@php $ic = $icon ?? 'shield'; @endphp
@if($ic === 'home')
    <svg width="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M9.13 20.77V17.72c0-.78.64-1.41 1.43-1.41h2.87c.38 0 .74.15 1.01.42.27.27.42.63.42 1v3.06c0 .33.13.64.36.87.23.23.55.35.88.35h1.96c.92.01 1.8-.35 2.45-.99.65-.64 1.01-1.51 1.01-2.42V9.87c0-.73-.33-1.43-.9-1.9L13.93 2.68c-1.16-.93-2.82-.9-3.95.07L3.47 7.97c-.59.46-.94 1.16-.97 1.9v8.57c0 1.9 1.55 3.43 3.46 3.43h1.92c.68 0 1.25-.54 1.25-1.22l.03-.88z" fill="currentColor"/>
    </svg>
@elseif($ic === 'shield')
    <svg width="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C9.243 2 7 4.243 7 7v1H6a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V10a2 2 0 00-2-2h-1V7c0-2.757-2.243-5-5-5zm-1 13.723V17a1 1 0 002 0v-1.277A2 2 0 1011 15.723zM9 7v1h6V7a3 3 0 00-6 0z" fill="currentColor"/>
    </svg>
@elseif($ic === 'users')
    <svg width="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" clip-rule="evenodd" d="M14.21 7.76c0 2.64-2.16 4.76-4.86 4.76C6.65 12.52 4.49 10.4 4.49 7.76 4.49 5.12 6.65 3 9.35 3c2.7 0 4.86 2.12 4.86 4.76zM2 17.92c0-2.45 3.39-3.06 7.35-3.06 3.98 0 7.35.63 7.35 3.08C16.7 20.39 13.31 21 9.35 21 5.36 21 2 20.37 2 17.92zM16.17 7.85c0 1.19-.41 2.3-1.06 3.2-.08.11.01.26.14.28.18.03.37.05.56.06 1.9.05 3.6-1.15 4.07-2.95.7-2.68-1.35-5.09-3.96-5.09-.28 0-.55.03-.82.08-.04.01-.07.03-.09.06-.02.04 0 .08.03.11.78 1.08 1.23 2.38 1.23 3.79v-.54zm3.15 5.85c1.28.24 2.12.74 2.47 1.46.3.59.3 1.28 0 1.88-.53 1.12-2.25 1.48-2.91 1.57-.14.02-.25-.11-.23-.25.34-3.11-2.37-4.59-3.07-4.93-.03-.02-.03-.04-.03-.05.01-.02.02-.03.04-.03 1.52-.03 3.15.16 3.73.35z" fill="currentColor"/>
    </svg>
@elseif($ic === 'person')
    <svg width="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" clip-rule="evenodd" d="M16.16 8.23c0 2.35-1.87 4.24-4.21 4.24C9.61 12.47 7.74 10.58 7.74 8.23 7.74 5.88 9.61 4 11.95 4c2.34 0 4.21 1.88 4.21 4.23zM11.95 20c-3.43 0-6.36-.54-6.36-2.72 0-2.17 2.91-2.74 6.36-2.74 3.43 0 6.36.54 6.36 2.72 0 2.18-2.91 2.74-6.36 2.74z" fill="currentColor"/>
    </svg>
@elseif($ic === 'tag')
    <svg width="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" clip-rule="evenodd" d="M21.79 10.54L13.46 2.21A2 2 0 0012.05 2H4a2 2 0 00-2 2v8.05c0 .53.21 1.04.59 1.41l8.33 8.33a2 2 0 002.83 0l7.05-7.05c.78-.78.78-2.05-.01-2.2zM6.5 8a1.5 1.5 0 110-3 1.5 1.5 0 010 3z" fill="currentColor"/>
    </svg>
@elseif($ic === 'building')
    <svg width="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M9.13 20.77V17.72c0-.78.64-1.41 1.43-1.41h2.87c.38 0 .74.15 1.01.42.27.27.42.63.42 1v3.06c0 .33.13.64.36.87.23.23.55.35.88.35h1.96c.92.01 1.8-.35 2.45-.99.65-.64 1.01-1.51 1.01-2.42V9.87c0-.73-.33-1.43-.9-1.9L13.93 2.68c-1.16-.93-2.82-.9-3.95.07L3.47 7.97c-.59.46-.94 1.16-.97 1.9v8.57c0 1.9 1.55 3.43 3.46 3.43h1.92c.68 0 1.25-.54 1.25-1.22l.03-.88z" fill="currentColor"/>
    </svg>
@elseif($ic === 'clock')
    <svg width="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2a10 10 0 100 20A10 10 0 0012 2zm1 11H8a1 1 0 010-2h4V7a1 1 0 012 0v5a1 1 0 01-1 1z" fill="currentColor"/>
    </svg>
@elseif($ic === 'calendar')
    <svg width="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" clip-rule="evenodd" d="M16.41 2.76l.01.75C19.17 3.73 20.99 5.61 20.99 8.49L21 16.92c.01 3.14-1.97 5.07-5.13 5.07l-7.72.01C5.01 22 3.01 20.02 3.01 16.88L3 8.55C2.99 5.66 4.75 3.78 7.51 3.53l-.01-.75c-.01-.44.32-.77.76-.77.43-.01.77.32.77.76l.01.75 5.86-.01-.01-.75c0-.44.33-.77.76-.77.43-.01.77.32.78.77z" fill="currentColor"/>
    </svg>
@elseif($ic === 'schedule')
    <svg width="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" clip-rule="evenodd" d="M20.84 2H3.16C2.52 2 2 2.52 2 3.16v17.68C2 21.48 2.52 22 3.16 22h17.68c.64 0 1.16-.52 1.16-1.16V3.16C22 2.52 21.48 2 20.84 2zM11.38 18.52H3.88v-.74h7.5v.74zm0-2.23H3.88v-1.52h7.5v1.52zm0-3.03H3.88v-1.52h7.5v1.52zm0-3.02H3.88V8.7h7.5v1.52zm0-3.02H3.88V5.67h7.5v1.52zm8.74-2.86h-8.74V2.64h8.74v1.52z" fill="currentColor"/>
    </svg>
@else
    <svg width="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="2"/>
        <path d="M12 8v4M12 16h.01" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
    </svg>
@endif
