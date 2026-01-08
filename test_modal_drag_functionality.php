<?php
// Test script for modal drag functionality
echo "<h1>Test Modal Drag Functionality</h1>";
echo "<p>Go to: <a href='http://localhost/Web_Cinema/index.php/Qlylich_controller/indexCalendar'>Calendar Page</a></p>";

echo "<h2>Instructions:</h2>";
echo "<ol>";
echo "<li>Open the calendar page in your browser</li>";
echo "<li>Click the 'Thêm lịch chiếu' button</li>";
echo "<li>Try to drag the modal by clicking and holding on the modal header</li>";
echo "<li>The modal should move with your mouse cursor</li>";
echo "<li>Release the mouse button to stop dragging</li>";
echo "</ol>";

echo "<h2>Expected Behavior:</h2>";
echo "<ul>";
echo "<li>✅ Modal header shows cursor: move when hovered</li>";
echo "<li>✅ Modal can be dragged around the screen</li>";
echo "<li>✅ Modal stays within window bounds</li>";
echo "<li>✅ Modal resets position when closed</li>";
echo "<li>✅ Console shows drag-related log messages</li>";
echo "</ul>";

echo "<h2>Debug Information:</h2>";
echo "<p><strong>Implementation:</strong> Pure JavaScript (no jQuery UI dependency)</p>";
echo "<p><strong>Events:</strong> mousedown, mousemove, mouseup on document</p>";
echo "<p><strong>Constraints:</strong> Modal stays within window viewport</p>";

echo "<h2>Browser Console Messages to Look For:</h2>";
echo "<pre>";
echo "Making modals draggable...
Mouse down on modal header
Mouse up - drag completed
Modal drag functionality added
</pre>";
?>







