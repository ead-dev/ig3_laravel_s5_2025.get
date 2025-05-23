import { CellPosition } from "../entities/cellPositionUtils";
import { BeanStub } from "../context/beanStub";
import { CtrlsService } from "../ctrlsService";
import { CellCtrl } from "../rendering/cell/cellCtrl";
import { RowCtrl } from "../rendering/row/rowCtrl";
import { RowRenderer } from "../rendering/rowRenderer";
import { HeaderNavigationService } from "../headerRendering/common/headerNavigationService";
export declare class NavigationService extends BeanStub {
    private mouseEventService;
    private paginationProxy;
    private focusService;
    private rangeService;
    private columnModel;
    private rowModel;
    ctrlsService: CtrlsService;
    rowRenderer: RowRenderer;
    headerNavigationService: HeaderNavigationService;
    private rowPositionUtils;
    private cellNavigationService;
    private pinnedRowModel;
    private gridBodyCon;
    constructor();
    private postConstruct;
    handlePageScrollingKey(event: KeyboardEvent, fromFullWidth?: boolean): boolean;
    private handlePageUpDown;
    private navigateTo;
    private onPageDown;
    private onPageUp;
    private navigateToNextPage;
    private navigateToNextPageWithAutoHeight;
    private getNextFocusIndexForAutoHeight;
    private getViewportHeight;
    private isRowTallerThanView;
    private onCtrlUpDownLeftRight;
    private onHomeOrEndKey;
    onTabKeyDown(previous: CellCtrl | RowCtrl, keyboardEvent: KeyboardEvent): void;
    tabToNextCell(backwards: boolean, event?: KeyboardEvent): boolean;
    private tabToNextCellCommon;
    private moveToNextEditingCell;
    private moveToNextEditingRow;
    private moveToNextCellNotEditing;
    private findNextCellToFocusOn;
    private isCellEditable;
    getCellByPosition(cellPosition: CellPosition): CellCtrl | null;
    private lookupRowNodeForCell;
    navigateToNextCell(event: KeyboardEvent | null, key: string, currentCell: CellPosition, allowUserOverride: boolean): void;
    private getNormalisedPosition;
    private tryToFocusFullWidthRow;
    private focusPosition;
    private isValidNavigateCell;
    private getLastCellOfColSpan;
    ensureCellVisible(gridCell: CellPosition): void;
}
